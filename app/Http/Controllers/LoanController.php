<?php

namespace App\Http\Controllers;

use App\Services\LoanService;
use App\Repositories\LoanRepository;

class LoanController extends Controller
{
    protected $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index()
    {
        $loans = app(LoanRepository::class)->all();
        return view('loan.index', compact('loans'));
    }

    public function process()
    {
        $this->loanService->processEmi();
        return redirect()->route('loan.emi');
    }

    public function emi()
    {
        $columns = $this->loanService->getEmiColumns();
        $records = $this->loanService->getEmiDetails();
        return view('loan.emi', compact('columns', 'records'));
    }
}

