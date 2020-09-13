<?php

namespace app\Controllers;

use app\Helpers\Account;
use app\Helpers\Http;


class BalanceController extends Controller
{
    public function requestGET()
    {
        $account = new Account;
        return $account->balance();
    }
}
