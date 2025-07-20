<?php

namespace App\Services;

use App\Repositories\LoanRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class LoanService
{
    protected $loanRepository;

    public function __construct(LoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    public function processEmi(): void
    {
        $loans = $this->loanRepository->all();
        if ($loans->isEmpty()) {
            return;
        }

        $range = $this->loanRepository->getDateRange();
        if (empty($range['min']) || empty($range['max'])) {
            return;
        }

        $startMonth = Carbon::parse($range['min'])->startOfMonth();
        $endMonth = Carbon::parse($range['max'])->startOfMonth();
        $months = [];

        foreach (CarbonPeriod::create($startMonth, '1 month', $endMonth) as $month) {
            $months[] = $month->format('Y_M');
        }

        DB::statement("DROP TABLE IF EXISTS emi_details");

        $columnSql = "`clientid` INT";
        foreach ($months as $month) {
            $columnSql .= ", `$month` DECIMAL(10,2) DEFAULT 0";
        }

        DB::statement("CREATE TABLE emi_details ($columnSql)");

        foreach ($loans as $loan) {
            $firstPaymentMonth = Carbon::parse($loan->first_payment_date)->startOfMonth();
            $endPeriodMonth = $firstPaymentMonth->copy()->addMonths($loan->num_of_payment - 1);
            $paymentPeriod = CarbonPeriod::create($firstPaymentMonth, '1 month', $endPeriodMonth);

            $emiRaw = $loan->loan_amount / $loan->num_of_payment;
            $emiAmount = floor($emiRaw * 100) / 100;
            $row = array_fill_keys($months, 0);
            $total = 0;
            $count = 0;

            foreach ($paymentPeriod as $month) {
                $key = $month->format('Y_M');
                $isLast = ($count === ($loan->num_of_payment - 1));
                $value = $isLast ? round($loan->loan_amount - $total, 2) : $emiAmount;
                $row[$key] = $value;
                $total += $value;
                $count++;
            }

            $insertData = ['clientid' => $loan->clientid] + $row;
            DB::table('emi_details')->insert($insertData);
        }
    }

    public function getEmiDetails()
    {
        return DB::table('emi_details')->get();
    }

    public function getEmiColumns(): array
    {
        return DB::getSchemaBuilder()->getColumnListing('emi_details');
    }
}
