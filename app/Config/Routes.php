<?php

use App\Controllers\Karyawan;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');

//Karyawan Routes
$routes->get('/karyawan', 'Karyawan::index'); //Client Side
$routes->post('/ajax', 'Karyawan::karyawanAjax');
$routes->post('/karyawan/delete', 'Karyawan::delete');
$routes->add('/karyawan/updateAdd', 'Karyawan::updateAdd');

//User Group Routing
$routes->get('/group', 'group::index');
$routes->post('/groupdtb', 'group::groupDtb');
$routes->add('/group/updateAdd', 'group::updateAdd');
$routes->post('/group/delete', 'group::delete');

//Menu routing
$routes->get('/menu', 'menu::index');
$routes->post('/menudtb', 'menu::menuDtb');
$routes->add('/menu/updateAdd', 'menu::updateAdd');
$routes->post('/menu/delete', 'menu::delete');

//pdf routing
$routes->get('/pdf', 'pdf::index');
$routes->get('/output', 'pdf::printPdf');

//permissions routing
$routes->get('/permission', 'permission::index');
$routes->post('/permidtb', 'permission::permiDtb');
$routes->add('/permission/updateAdd', 'permission::updateAdd');
$routes->post('/permission/delete', 'permission::delete');
