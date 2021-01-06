<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'Main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// App user api's 
$route['Anti_corruption_categories'] = 'Anti_corruption_api/Categories';
$route['Anti_corruption_laws'] = 'Anti_corruption_api/laws';
$route['Anti_corruption_feedback'] = 'Anti_corruption_api/feedback';
$route['Anti_corruption_report'] = 'Anti_corruption_api/Anti_corruption_report';