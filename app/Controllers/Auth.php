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
}
