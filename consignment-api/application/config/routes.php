<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
INTERFACE
*/

$route['default_controller'] = 'Home';


/*
SERVICES
*/
require_once APPPATH . 'cache/routes.php';;

$route['404_override'] = 'errors/page_not_found';
$route['translate_uri_dashes'] = FALSE;
