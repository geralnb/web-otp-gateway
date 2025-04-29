<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth routes
$routes->get('auth/login', 'Auth::login');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/valid-register', 'Auth::valid_register');
$routes->post('auth/valid-login', 'Auth::valid_login');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/reset-password', 'Auth::forgotPassword');
$routes->post('auth/reset-password-valid', 'Auth::valid_reset');
$routes->get('auth/verify-otp', 'Auth::verifyOTP');
$routes->post('auth/valid-verify-otp', 'Auth::valid_verifyOTP');
$routes->get('auth/new-password', 'Auth::newPassword');
$routes->post('auth/valid-new-password', 'Auth::resetPassword');


// Page User
$routes->get('user', 'User::index');
$routes->get('profile', 'Profile::index');
$routes->post('profile/update-password', 'Profile::updatePassword');
$routes->get('hubungi-kami', 'Contact::index');
$routes->get('mutasi', 'RiwayatSaldo::index');
// Deposit//
$routes->get('deposit', 'Deposits::index');
$routes->post('process-deposits', 'Deposits::deposit');
$routes->post('deposit-callback', 'Paydisini::callback');


// API Get Services
$routes->get('sistem/get-services', 'Turbootp\Sistem::getServices');
// API Get Status Waiting
$routes->get('sistem/update-status', 'Turbootp\Sistem::updateWaitingOrders');
// API Update Status Done All >20m
$routes->get('sistem/update-all-status', 'Turbootp\Sistem::updateAllOrders');


// Orders TurboOtp //
$routes->get('orders', 'Turbootp\Orders::index');
$routes->post('orders-proces', 'Turbootp\Orders::placeOrder');
$routes->get('orders/changeStatusCancel/(:any)', 'Turbootp\Orders::changeStatusCancel/$1');
$routes->get('orders/retryOrder/(:any)', 'Turbootp\Orders::retryOrder/$1');
$routes->get('orders/doneOrder/(:any)', 'Turbootp\Orders::doneOrder/$1');


// History //
$routes->get('history', 'Turbootp\History::index');



// Page Admin
$routes->get('admin', 'Admin\Admin::index');
$routes->get('admin/settings-web', 'Admin\SettingsWeb::index');
$routes->post('admin/settings-web/update', 'Admin\SettingsWeb::update');
$routes->get('admin/contact', 'Admin\Contact::index');
$routes->post('admin/contact/update', 'Admin\Contact::update');

// Services Admin
$routes->get('admin/services', 'Admin\Services::index');
$routes->get('admin/get-data-services', 'Admin\Services::getDataServices');
$routes->post('admin/services/update/(:segment)', 'Admin\Services::update/$1');
$routes->post('admin/services/delete/(:segment)', 'Admin\Services::delete/$1');

// Orders admin
$routes->get('admin/orders', 'Admin\Orders::index');
$routes->post('admin/orders/update/(:segment)', 'Admin\Orders::update/$1');
$routes->post('admin/orders/delete/(:segment)', 'Admin\Orders::delete/$1');

// User Admin
$routes->get('admin/user', 'Admin\User::index');
$routes->post('admin/user/edit/(:num)', 'Admin\User::edit/$1');
$routes->get('admin/user/hapus/(:num)', 'Admin\User::delete/$1');

// Deposit Admin
$routes->get('admin/deposit', 'Admin\Deposit::index');
$routes->get('admin/deposit/hapus/(:num)', 'Admin\Deposit::delete/$1');