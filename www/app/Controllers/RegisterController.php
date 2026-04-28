<?php

namespace App\Controllers;

use App\Models\UserModel;

class RegisterController extends BaseController
{

    public function signUp()
    {
        return view('register');
    }

    public function signUpPost()
    {

        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]|salle_email',
            'password' => 'required|min_length[7]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/]',
            'password_repeat' => 'required|matches[password]'
        ];

        $errors = [
            'email' => [
                'required' => 'Email is required.',
                'valid_email' => 'The email address is not valid.',
                'is_unique' => 'The email address is already registered.',
                'salle_email' => 'Only emails from the domain @salle.url.edu are accepted.'
            ],
            'password' => [
                'required' => 'Password is required.',
                'min_length' => 'The password must contain at least 7 characters.',
                'regex_match' => 'The password must contain both upper and lower case letters and numbers.'
            ],
            'password_repeat' => [
                'required' => 'Repeat password is required.',
                'matches' => 'Passwords do not match.'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        return $this->store();




    }
    private function store(){
        $userModel = new UserModel();

        $data = [
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        if ($userModel->insert($data)) {
            return redirect()->to('/sign-in');
        }
        return redirect()->back()->withInput()->with('errors', $userModel->errors());
    }
}