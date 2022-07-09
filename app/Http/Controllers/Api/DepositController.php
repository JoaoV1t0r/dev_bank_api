<?php

namespace App\Http\Controllers\Api;

use App\Domains\Deposit\Services\Abstract\IDepositStoreService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    private IDepositStoreService $depositStoreService;

}
