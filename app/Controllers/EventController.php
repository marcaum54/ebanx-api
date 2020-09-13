<?php

namespace app\Controllers;

use app\Helpers\Http;
use app\Helpers\Account;



class EventController extends Controller
{
    public function requestPOST()
    {
        $account = new Account;
        return $account->process_event();
    }
}
