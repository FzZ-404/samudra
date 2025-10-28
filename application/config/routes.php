<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['dashboard'] = 'dashboard/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//admin
$route['admin']                 = 'admin/dashboard';
$route['admin/dashboard']       = 'admin/dashboard/index';

$route['admin/articles']        = 'admin/articles/index';
$route['admin/articles/create'] = 'admin/articles/create';
$route['admin/articles/store']  = 'admin/articles/store';
$route['admin/articles/(:num)/edit']   = 'admin/articles/edit/$1';
$route['admin/articles/(:num)/update'] = 'admin/articles/update/$1';
$route['admin/articles/(:num)/delete'] = 'admin/articles/delete/$1';
