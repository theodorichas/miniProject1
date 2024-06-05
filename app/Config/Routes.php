<?php

use App\Controllers\Karyawan;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');
$routes->get('/', 'Home::index');
$routes->get('/change-language/(:any)', 'Home::changeLanguage/$1');


//Karyawan Routes
$routes->get('/karyawan', 'Karyawan::index'); //Client Side
$routes->get('/change-language/(:any)', 'Karyawan::changeLanguage/$1');

$routes->post('/ajax', 'Karyawan::karyawanAjax');
$routes->post('/karyawan/delete', 'Karyawan::delete');
$routes->post('/karyawan/status', 'Karyawan::status');
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

//Log-in routing
$routes->get('/login', 'auth::login');
$routes->post('/loginAuth', 'auth::loginAuth');
$routes->get('/logout', 'auth::logout');

//register routing
$routes->get('/register', 'auth::register');
$routes->post('/registerAuth', 'auth::registerAuth');
$routes->get('/verify/(:any)', 'auth::verify/$1');

//forget password routing
$routes->get('/forgetPassword', 'auth::forget'); // to load the view page for the "Forget Password"
$routes->post('/forgetAuth', 'auth::forgetAuth'); //access the data that is being send from the frontend
$routes->get('/resetPassForm/(:any)', 'auth::showResetPasswordForm/$1');
$routes->post('/resetPass', 'auth::resetPassword');



//testing purpose
$routes->get('/testing', 'home::testing');

service('auth')->routes($routes);
