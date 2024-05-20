<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;
use App\Models\ModelPasswordRes;
use Config\Services;


class Auth extends BaseController
{
    protected $db, $builder, $ModelKaryawan, $ModelPasswordRes, $email;


    //log-in
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('karyawan');
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelPasswordRes = new ModelPasswordRes();
        $this->request = \Config\Services::request();
        $this->email = \Config\Services::email();
        helper('general_helper');
    }

    public function login()
    {
        /* 
        // Check if session is active
        if (session_status() === PHP_SESSION_ACTIVE) {
            // Session is active
            echo "Session is active";
        } else {
            // Session is not active
            echo "Session is not active";
        }
        */
        $data['title'] = 'login';
        return view('login/index', $data);
    }

    public function loginAuth()
    {
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        if (empty($email) || empty($password)) {
            return $this->response->setJSON(['error' => 'Email and password are required']);
        }

        // Retrieve user from database
        $user = $this->ModelKaryawan->getUserByEmail($email);


        if (!$user) {
            return $this->response->setJSON(['error' => 'User not found']);
        }
        // Verify user Password
        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON(['error' => 'Invalid password']);
        }

        $_SESSION['user_id'] = $user['user_id']; // Example: Store user ID
        $_SESSION['email'] = $user['email']; // Example: Store email
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['group_name'] = $user['group_name'];

        return $this->response->setJSON(['success' => 'Login successful']);

        // Debug information
        /*
        $debugInfo = [
            'email' => $email,
            'password_entered' => $password,
            'hashed_password_stored' => $user['password'], // Hashed password retrieved from the database
            'password_verification' => password_verify($password, $user['password']) ? 'Match' : 'Mismatch',
            'user_id' => $_SESSION['user_id'],
            'email' => $_SESSION['email'],
            'nama' => $_SESSION['nama'],
        ];

        // Return debug information in JSON format
        return $this->response->setJSON(['debug' => $debugInfo]);
        */
    }

    public function logout()
    {
        // Destroy session upon logout
        session_destroy();
        // Redirect to the login page after logout
        return redirect()->to('/login');
    }


    /// ---------- /////

    //register
    public function register()
    {
        $data['title'] = 'register';
        return view('register/index', $data);
    }

    public function registerAuth()
    {

        $userId = intval($this->request->getPost('userId'));
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $defaultGroupName = 'Staff';

        $data = [
            'userId' => $userId,
            'nama' => $nama,
            'email' => $email,
            'password' => $hashedPassword,
            'group_name' => $defaultGroupName,
        ];
        $existingUser = $this->ModelKaryawan->getUserByEmail($email);

        if (!$existingUser) {
            $this->ModelKaryawan->add_dataKaryawan($data);
            return $this->response->setJSON(['success' => 'Regis successful']);
        } else {
            return $this->response->setJSON(['error' => 'User already exists']);
        }
    }

    //forget password view
    public function forget()
    {
        $data['title'] = "Forget Password";
        return view('forget-password/index', $data);
    }

    //logic forget password
    public function forgetAuth()
    {
        //Getting the inputted email from the form in (forget-password/index view)
        $email = $this->request->getPost('email');
        //Check to the database if the user exist within the database
        $user = $this->ModelKaryawan->emailValid($email);
        //This will show an alert if a the entered email is not present in the database
        if (!$user) {
            return $this->response->setJSON(['error' => true, 'message' => 'Email not found']);
        } else {
            //This will generate a random and unique token
            $token = $token = bin2hex(random_bytes(32));
            $data = [
                'email' => $email,
                'token' => $token,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->ModelPasswordRes->insertData($data);
            $this->email->setFrom('testing.magang@gmail.com', 'Arona');
            $this->email->setTo($email);
            $this->email->setSubject('Ohayou Sensei');
            $this->email->setMessage('<p>Click this link to reset your password:</p> <a href="' . site_url('/resetPassForm/' . $token) . '">Password Reset</a>');
            if (!$this->email->send()) {
                return $this->response->setJSON(['error' => true, 'message' => 'There is an error!! Verification has not been sent']);
            } else {
                return $this->response->setJSON(['success' => true, 'message' => 'A verification link has been sent to your email']);;
            }
        }
    }

    public function showResetPasswordForm($token)
    {
        // Check if the token exists in the password_resets table
        $resetRequest = $this->ModelPasswordRes->tokenRequest($token);
        // If the token does not exist or is older than 1 hour, redirect with an error message
        if ($resetRequest) {
            print_r($resetRequest);
        } else {
            print_r($token);
        }
        die();
        // If the token is valid, show the password reset form
        return view('forget-password/recoverPass', ['token' => $token]);
    }

    public function resetPassword()
    {
        $token = $this->request->getPost('token');
        $resetInfo = $this->ModelPasswordRes->where('token', $token)->first();

        if (!$resetInfo) {
            return $this->response->setJSON(['error' => 'Invalid or expired token']);
        }

        $email = $resetInfo['email'];
        $newPassword = (string) $this->request->getPost('password');
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $this->ModelKaryawan->updateByEmail($email, ['password' => $hashedPassword]);
        $this->ModelPasswordRes->where('token', $token)->delete();

        return $this->response->setJSON(['success' => 'Password reset successful']);
    }
}
