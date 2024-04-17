<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;


class Auth extends BaseController
{

    protected $db, $builder, $ModelKaryawan;
    //log-in
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('karyawan');
        $this->ModelKaryawan = new ModelKaryawan();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function login()
    {
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

        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON(['error' => 'Invalid password']);
        }

        return $this->response->setJSON(['success' => 'Login successful']);

        $_SESSION['user_id'] = $user['user_id']; // Example: Store user ID
        $_SESSION['email'] = $user['email']; // Example: Store email
        $_SESSION['nama'] = $user['nama'];
        // Debug information
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
    }

    public function logout()
    {
        // Destroy session upon logout
        session_destroy();
        // Redirect to the login page after logout
        return redirect()->to('/login');
    }

    public function isLoggedIn()
    {
        // Check if the user is logged in by verifying the presence of session data
        return isset($_SESSION['user_id']);
    }


    /// ---------- /////

    //register
    public function register()
    {
        $data['title'] = 'register';
        return view('register/index', $data);
    }
}
