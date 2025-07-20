<?php

namespace App\Repositories;

use App\Models\LoanDetail;

class LoanRepository
{
    public function all()
    {
        return LoanDetail::all();
    }

    public function getDateRange()
    {
        return [
            'min' => LoanDetail::min('first_payment_date'),
            'max' => LoanDetail::max('last_payment_date'),
        ];
    }
}
