<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;
use App\Models\ModelgPermission;
use App\Models\ModelKaryawan;

class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Retrieve user's group name from session
        $groupName = session()->get('group_name');

        // Check if the group name is set
        if (!$groupName) {
            // If the group name is not set, it means the user is not logged in
            // Redirect the user to the login page or perform any other action
            return redirect()->to('/login');
        }
    }



    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Retrieve user's group name from session
        $groupName = session()->get('group_name');

        // Check if the user is logged in and has a group name
        if ($groupName) {
            // Redirect the user to the home page
            return redirect()->to('/home');
        }

        // No action needed if the user is not logged in
        return $response;
    }
}
