<?php

namespace app\Controllers;

use app\Helpers\Http;
use app\Helpers\Account;

class ResetController extends Controller
{
    public function requestPOST()
    {
        $account = new Account;
        return $account->reset();
    }
}
