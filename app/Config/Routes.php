<?php

use App\Controllers\Karyawan;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');
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
$routes->post('/output', 'pdf::printPdf');
$routes->get('/userdata', 'pdf::userdata');
$routes->post('/read', 'pdf::read');


//gPermissions routing
$routes->get('/gPermission', 'gpermission::index');
$routes->get('/gpermidtb', 'gpermission::gpermiDtb');
$routes->add('/gpermi/updateAdd', 'gpermission::updateAdd');

//Log-in & register routing
$routes->get('/login', 'auth::login');
$routes->post('/loginAuth', 'auth::loginAuth');
$routes->get('/logout', 'auth::logout');
$routes->get('/register', 'auth::register');
$routes->post('/registerAuth', 'auth::registerAuth');





//testing purpose
$routes->get('/testing', 'home::testing');
