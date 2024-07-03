<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;
use App\Models\ModelPasswordRes;
use Config\Services;
use PhpParser\Node\Expr\Isset_;

class Auth extends Home
{
    protected $db, $builder, $ModelKaryawan, $ModelPasswordRes, $email;


    //---- Log-in ----//
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
        if (isset($_SESSION['nama']) && isset($_SESSION['user_id']) == true) {
            return view('error-page/login-error');
        }
        $data['title'] = 'login';
        return view('login/index', $data);
    }

    public function loginAuth()
    {
        //Captcha
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $secretKey = '6LeyX-IpAAAAABBr1oLv6tsAJWP1PqhunfWPrPfW';
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';

        // Verify the reCAPTCHA response
        $response = file_get_contents($recaptchaUrl . '?secret=' . $secretKey . '&response=' . $recaptchaResponse);
        $responseKeys = json_decode($response, true);

        if (!$responseKeys["success"]) {
            return $this->response->setJSON(['error' => true, 'message' => 'Please complete the CAPTCHA']);
        }

        //login logic
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        if (empty($email) || empty($password)) {
            return $this->response->setJSON(['error' => 'Email and password are required']);
        }

        // Retrieve user from database
        $user = $this->ModelKaryawan->getUserByEmail($email);

        if (!$user) {
            return $this->response->setJSON(['error' => true, 'message' => 'User not found']);
        }
        if ($user['is_verified'] == 0) {
            return $this->response->setJSON(['error' => true, 'message' => 'User is not verified, Please contact your Admin or Check your E-mail for a verification link']);
        }
        // Verify user Password
        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON(['error' => 'Invalid password']);
        }

        $_SESSION['user_id'] = $user['user_id']; // Example: Store user ID
        $_SESSION['email'] = $user['email']; // Example: Store email
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['group_name'] = $user['group_name'];
        // $_SESSION['language'] = $user['language_preference'];


        // Redirect to home page
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

    //---- Register ----//
    public function register()
    {
        $data['title'] = 'register';
        return view('register/index', $data);
    }

    public function registerAuth()
    {
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $secretKey = '6LeyX-IpAAAAABBr1oLv6tsAJWP1PqhunfWPrPfW';
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';

        // Verify the reCAPTCHA response
        $response = file_get_contents($recaptchaUrl . '?secret=' . $secretKey . '&response=' . $recaptchaResponse);
        $responseKeys = json_decode($response, true);

        if (!$responseKeys["success"]) {
            return $this->response->setJSON(['error' => true, 'message' => 'Please complete the CAPTCHA']);
        }


        $userId = intval($this->request->getPost('userId'));
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(32));
        $defaultAddress = 'To be Updated';
        $defaultPhoneNumber = 'To be Updated';
        $defaultGroupName = 'Staff';

        $data = [
            'userId' => $userId,
            'nama' => $nama,
            'telp' => $defaultPhoneNumber,
            'alamat' => $defaultAddress,
            'email' => $email,
            'password' => $hashedPassword,
            'group_name' => $defaultGroupName,
            'token' => $token,
            'is_verified' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $group_id = $this->ModelKaryawan->getGroupIdByName($defaultGroupName);
        $existingUser = $this->ModelKaryawan->getUserByEmail($email);

        if (!$existingUser) {
            $this->ModelKaryawan->add_dataKaryawan($data);
            $user_id = $this->ModelKaryawan->insertID();
            $this->ModelKaryawan->insertUserGroup($user_id, $group_id);
            $this->sendEmailverif($email, $token);
            return $this->response->setJSON(['success' => true, 'message' => 'An Email verification link has been sent to your inbox']);
        } else {
            return $this->response->setJSON(['error' => true, 'message' => 'User already exists']);
        }
    }

    //register verification link
    private function sendEmailverif($email, $token)
    {
        $this->email->setFrom('testing.magang@gmail.com', 'Arona');
        $this->email->setTo($email);
        $this->email->setSubject('Ohayou Sensei');
        $this->email->setMessage('<p>Click the link below to verify your email:</p> <a href="' . site_url('/verify/' . $token) . '">Verify Email</a>');
        if (!$this->email->send()) {
            return $this->response->setJSON(['error' => true, 'message' => 'There is an error!! Verification has not been sent']);
        } else {
            return $this->response->setJSON(['success' => true, 'message' => 'A verification link has been sent to your email']);;
        }
    }

    public function verify($token)
    {
        // Fetch the token request from the database
        $tokenRequest = $this->ModelKaryawan->tokenRequest($token);

        if (!$tokenRequest) {
            // Token does not exist
            return redirect()->to('/register')->with('error', 'Invalid token or the token has expired.');
        }

        // Calculate token expiration time
        $tokenCreatedAt = new \DateTime($tokenRequest['created_at']);
        $currentDateTime = new \DateTime();
        $tokenExpirationTime = $tokenCreatedAt->modify('+1 hour');

        if ($tokenExpirationTime < $currentDateTime) {
            // Token is expired
            return redirect()->to('/register')->with('error', 'Expired token.');
        }

        // Verify user by token
        $user = $this->ModelKaryawan->getToken($token);

        if ($user && !$user->is_verified) {
            // Update user as verified
            $this->ModelKaryawan->update($user->user_id, [
                'is_verified' => true,
                'token' => null
            ]);
            return redirect()->to('/login')->with('success', 'Verification successful! You can now log in.');
        } else {
            return redirect()->to('/register')->with('error', 'There is an error!! Please try again in a few minutes.');
        }
    }



    // ----- Forget Password ------ //
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
            // Prepare email content
            $emailContent = view('template/reset_pass', [
                'token' => $token,
            ]);
            $this->ModelPasswordRes->insertData($data);
            $this->email->setFrom('testing.magang@gmail.com', 'Arona');
            $this->email->setTo($email);
            $this->email->setSubject('Ohayou Sensei');
            // $this->email->setMessage('<p>Click this link to reset your password:</p> <a href="' . site_url('/resetPassForm/' . $token) . '">Password Reset</a>');
            $this->email->setMessage($emailContent);
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
        if (!$resetRequest) {
            // Token does not exist
            return redirect()->to('auth/forget')->with('error', 'Invalid token.');
        }

        //Make a variable that stores the token and datetime
        $tokenCreatedAt = new \DateTime($resetRequest['created_at']);
        $currentDateTime = new \DateTime();
        //Make a variable that stores the token expiration time
        $tokenExpirationTime = $tokenCreatedAt->modify('+1 hour');
        //Ater that we make an IF condition where if the current date time is greater than the token's it validates 
        if ($tokenExpirationTime < $currentDateTime) {
            // Token is expired
            return redirect()->to('auth/forget')->with('error', 'Expired token.');
        }
        // If the token is valid, show the password reset form
        return view('forget-password/recoverPass', ['token' => $token]);
    }

    public function resetPassword()
    {
        //Grab the Token from the POST request of the form
        $token = $this->request->getPost('token');
        if (!$token) {
            return $this->response->setJSON(['error' => true, 'message' => 'Token is not set']);
        }

        //Validate the token
        $resetInfo = $this->ModelPasswordRes->getToken($token);
        if (!$resetInfo) {
            return $this->response->setJSON(['error' => true, 'message' => 'Invalid or expired token']);
        }

        // Extract email associated with the token
        $email = $resetInfo->email;
        $newPassword = (string) $this->request->getPost('password');
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $data = [
            $hashedPassword,
        ];

        $this->ModelKaryawan->updateByEmail($email, ['password' => $hashedPassword]);
        $this->ModelPasswordRes->deleteToken($token);
        return $this->response->setJSON(['success' => true, 'message' => 'Password reset successful, you will be redirected shortly']);
    }
}
