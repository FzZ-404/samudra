<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['dashboard'] = 'dashboard/index';
$route['edukasi'] = 'edukasi/index';
$route['event'] = 'event/index';
$route['quiz'] = 'quiz/index';

$route['admin'] = 'admin/dashboard';
$route['admin/dashboard'] = 'admin/dashboard/index';

/* ===== ARTICLES ===== */
$route['admin/articles'] = 'admin/articles/index';
$route['admin/articles/create'] = 'admin/articles/create';
$route['admin/articles/store'] = 'admin/articles/store';
$route['admin/articles/(:num)/edit'] = 'admin/articles/edit/$1';
$route['admin/articles/(:num)/update'] = 'admin/articles/update/$1';
$route['admin/articles/(:num)/delete'] = 'admin/articles/delete/$1';

/* ===== EVENTS ===== */
$route['admin/events'] = 'admin/events/index';
$route['admin/events/create'] = 'admin/events/create';
$route['admin/events/store'] = 'admin/events/store';
$route['admin/events/(:num)/edit'] = 'admin/events/edit/$1';
$route['admin/events/(:num)/update'] = 'admin/events/update/$1';
$route['admin/events/(:num)/delete'] = 'admin/events/delete/$1';

/* ===== QUIZZES ===== */
$route['admin/quizzes'] = 'admin/quizzes/index';
$route['admin/quizzes/create'] = 'admin/quizzes/create';
$route['admin/quizzes/store'] = 'admin/quizzes/store';
$route['admin/quizzes/(:num)/edit'] = 'admin/quizzes/edit/$1';
$route['admin/quizzes/(:num)/update'] = 'admin/quizzes/update/$1';
$route['admin/quizzes/(:num)/delete'] = 'admin/quizzes/delete/$1';

$route['quiz'] = 'quiz/index';
$route['quiz/start/(:num)'] = 'quiz/start/$1';
$route['quiz/submit/(:num)'] = 'quiz/submit/$1';

$route['admin/quizzes/add_question/(:num)'] = 'admin/quizzes/add_question/$1';
$route['admin/quizzes/(:num)/delete_question/(:num)'] = 'admin/quizzes/delete_question/$1/$2';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
