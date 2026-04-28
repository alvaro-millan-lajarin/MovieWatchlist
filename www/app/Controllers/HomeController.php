<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $session = session();
        $username = "stranger";


        if ($session->has('user_email')) {
            $email = $session->get('user_email');
            $username = explode('@', $email)[0];
        }


        return view('home', [
            'username' => $username,
            'isLoggedIn' => $session->get('isLoggedIn')
        ]);
    }
}