<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{


    public function signIn()
    {
        return view('login');
    }

    public function signInPost()
    {
        $rules = [
            'email' => 'required|valid_email|salle_email',
            'password' => 'required|min_length[7]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/]'
        ];

        $errors = [
            'email' => [
                'required' => 'Email is required.',
                'valid_email' => 'The email address is not valid.',
                'salle_email' => 'Only emails from the domain @salle.url.edu are accepted.'
            ],
            'password' => [
                'required' => 'Password is required.',
                'min_length' => 'The password must contain at least 7 characters.',
                'regex_match' => 'The password must contain both upper and lower case letters and numbers.'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return $this->authenticate();
    }

    private function authenticate()
    {
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('errors', [
                'email' => 'User with this email address does not exist.'
            ]);
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('errors', [
                'password' => 'Your email and/or password are incorrect.'
            ]);
        }


        session()->set([
            'user_id' => $user['id'],
            'user_email' => $user['email'],
            'isLoggedIn' => true
        ]);

        return redirect()->to('/');
    }
    public function logout()
    {

        session()->destroy();

        return redirect()->to('/sign-in');
    }
}