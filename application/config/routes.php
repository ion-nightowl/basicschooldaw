<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['logout'] = 'auth/logout';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
