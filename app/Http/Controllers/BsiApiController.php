<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BsiApiService;

class BsiApiController extends Controller
{
    protected $bsiApiService;

    public function __construct(BsiApiService $bsiApiService)
    {
        $this->bsiApiService = $bsiApiService;
    }

    public function testApi()
    {
        $vaNumber = '123456789012345';
        $amount = 100000;
        $transactionDate = date('Y-m-d');

        $transaction = $this->bsiApiService->createTransaction([
            'va_number' => $vaNumber,
            'amount' => $amount,
            'transaction_date' => $transactionDate,
        ]);

        return response()->json($transaction);
    }
}
