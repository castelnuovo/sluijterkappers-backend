<?php

namespace App\Controllers;

use CQ\Helpers\Session;
use CQ\Config\Config;
use CQ\Controllers\Auth;

class AuthController extends Auth
{
    public function logout($msg = 'logout')
    {
        Session::destroy();

        return $this->redirect('https://auth.castelnuovo.xyz/oauth2/authorize?client_id=' . Config::get('auth.id'));
    }
}
