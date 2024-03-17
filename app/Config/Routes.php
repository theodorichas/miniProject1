<?php

use App\Controllers\Karyawan;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//User account / karyawan account routing
$routes->get('/', 'Home::index');
$routes->get('/karyawan', 'Karyawan::index'); //Client Side
$routes->post('/ajax', 'Karyawan::karyawanAjax');
$routes->post('/karyawan/delete', 'Karyawan::delete');
$routes->add('/karyawan/updateAdd', 'Karyawan::updateAdd');

//User Group Routing
$routes->get('/group', 'group::index');
$routes->post('/groupdtb', 'group::groupDtb');
$routes->add('/group/updateAdd', 'group::updateAdd');
$routes->post('/group/delete', 'group::delete');
