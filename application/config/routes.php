<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'security/check';



//routes
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login']['post'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['user']['post'] = 'user/update';
$route['student/([0-9]+)']['get'] = 'student/viewStudentDetails/$1';
$route['student/([0-9]+)/([0-9]+)']['get'] = 'student/getStudentList/$1/$2';
$route['user/([a-z0-9A-Z]+)']['get'] = 'user/getUserDetails/$1';
$route['user']['get'] = 'user/getMyDetails';
$route['class']['get'] = 'classDetails/getDetails';
$route['class/list/([a-z0-9A-Z]+)']['get'] = 'classSection/getClassList/$1';
$route['class/list']['get'] = 'classSection/getClassList';
$route['exams/([0-9]+)/([0-9]+)']['get'] = 'exams/getExamsForClass/$1/$2';
$route['exams/organization/([0-9]+)'] = 'exams/getExamsForOrga/$1';

//methods not allowed
$route['status405'] = 'rejectRequest/status405';
$route['login']['get'] = $route['status405'];
$route['login']['put'] = $route['status405'];
$route['login']['delete'] = $route['status405'];
$route['(.*)'] = $route['404_override'];
