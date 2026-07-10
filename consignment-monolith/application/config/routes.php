<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
INTERFACE
*/

$route['default_controller'] = 'commerce--home/Home/index';


//COMMERCE - User
$route['my-account/bank-account'] = 'commerce--user/UserBankAccount/index';

//GLOBAL - Account User
$route['login'] = 'global--account-user/Login/index';
$route['register'] = 'global--account-user/Register/index';
$route['register/activation'] = 'global--account-user/Register/activation';
$route['forgot-password'] = 'global--account-user/PasswordForgot/index';
$route['forgot-password/reset'] = 'global--account-user/PasswordForgot/reset';
$route['my-account'] = 'global--account-user/UserProfile/index';
$route['my-account/profile/edit'] = 'global--account-user/UserProfile/edit';
$route['my-account/profile/change-password'] = 'global--account-user/UserProfile/passwordChange';

$route['404_override'] = 'errors/page_not_found';
$route['translate_uri_dashes'] = FALSE;
