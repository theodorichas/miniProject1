<?php
// app/Filters/PermissionFilter.php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;

use app\Models\ModelgPermission;
use App\Models\ModelKaryawan;



class PermissionFilter implements FilterInterface
{
    protected $ModelgPermission, $ModelKaryawan;

    public function __construct()
    {
        $this->ModelgPermission = new ModelgPermission;
        $this->ModelKaryawan = new ModelKaryawan();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        // Check permission before allowing access to the route
        // Retrieve user's group name from session or any other source
        $groupName = session()->get('group_name');

        // Perform permission check based on route and group name
        if (!$this->hasPermission($request->uri->getPath(), $groupName)) {
            // Permission denied, redirect or show error message
            return redirect()->to('/error');
        }

        // Permission granted, allow access to the route
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after processing the request
        return $response;
    }

    private function hasPermission(string $route, string $groupName)
    {

        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $permissions = $this->ModelgPermission->get_permission($groupId);
        $route = $this->$_REQUEST->uri->getPath();


        // Implement logic to check permission based on route and group name
        // This could involve querying the database, checking configuration, etc.
        // Return true if the user has permission, false otherwise

        //Akan cek permissions, apabula view 1 maka routing bisa dijalankan
        foreach ($permissions as $permission) {
            // Check if the permission is set to view (1) and matches the given route
            if ($permission['view'] == 1 && $permission['menu_id'] == $route) {
                return true; // User has permission to access the route
            }
        }
        return false;
    }
}
