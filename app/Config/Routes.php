<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->add('modifier/(:alpha)/(:num)', 'Modifier::$1/$2');
$routes->match(['get', 'post'], 'modifier/create', 'Modifier::create');
$routes->get('modifier/(:num)', 'Modifier::view/$1');
$routes->get('modifier', 'Modifier::index');

$routes->add('addon/(:alpha)/(:num)', 'AddOn::$1/$2');
$routes->match(['get', 'post'], 'addon/create', 'AddOn::create');
$routes->get('addon/(:num)', 'AddOn::view/$1');
$routes->get('addon', 'AddOn::index');

$routes->add('category/(:alpha)/(:num)', 'Category::$1/$2');
$routes->match(['get', 'post'], 'category/create', 'Category::create');
$routes->get('category/(:num)', 'Category::view/$1');
$routes->get('category', 'Category::index');

$routes->add('item/(:alpha)/(:num)', 'Item::$1/$2');
$routes->match(['get', 'post'], 'item/getItemsByCategory/(:num)', 'Item::getItemsByCategory/$1');
$routes->match(['get', 'post'], 'item/create', 'Item::create');
$routes->get('item/(:num)', 'Item::view/$1');
$routes->get('item', 'Item::index');

$routes->match(['get', 'post'], 'order/create', 'Order::create');
$routes->add('order/(:alpha)/(:num)', 'Order::$1/$2');
$routes->get('order/(:num)', 'Order::view/$1');
$routes->get('order', 'Order::index');

$routes->add('customer/(:alpha)/(:num)', 'Customer::$1/$2');
$routes->get('customer/(:num)', 'Customer::view/$1');
$routes->get('customer', 'Customer::index');

$routes->add('user/(:alpha)/(:num)', 'User::$1/$2');
$routes->match(['get', 'post'], 'user/create', 'User::create');
$routes->get('user/(:alpha)', 'User::$1');
$routes->match(['get', 'post'], 'user/login', 'User::login');
$routes->get('user/(:num)', 'User::view/$1');
$routes->get('user', 'User::index');

$routes->get('dashboard/getMonthlyTotal/(:num)', 'Dashboard::getMonthlyTotal/$1');
$routes->get('dashboard/getMonthlyTotal', 'Dashboard::getMonthlyTotal');
$routes->get('dashboard/getTopSeller', 'Dashboard::getTopSeller');
$routes->get('dashboard/getTimingData', 'Dashboard::getTimingData');
$routes->get('dashboard/(:any)', 'Dashboard::view/$1');
$routes->get('dashboard', 'Dashboard::index');

$routes->get('/', 'User::login');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
