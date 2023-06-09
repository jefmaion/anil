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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'AuthController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['setup/login'] = 'SetupController/index';
$route['setup/auth'] = 'SetupController/auth';
$route['setup'] = 'SetupController/show';
$route['setup/store']['post'] = 'SetupController/store';
$route['setup/logout'] = 'SetupController/logout';

$route['auth'] = 'AuthController/index';
$route['logout'] = 'AuthController/logout';
$route['auth/login']['post'] = 'AuthController/auth';
$route['auth/add']['post'] = 'AuthController/add';

$route['admin'] = 'FolderController/index';

$route['admin/folder/create']['post'] = 'FolderController/create';
$route['admin/folder/(:num)/show'] = 'FolderController/show/$1';
$route['admin/folder/(:num)/upload']['post'] = 'FolderController/upload/$1';
$route['admin/folder/(:num)/delete']['post'] = 'FolderController/delete/$1';
$route['admin/folder/reset'] = 'FolderController/reset';
$route['admin/folder/export'] = 'FolderController/export';


$route['admin/users'] = 'UserController/index';
$route['admin/users/store']['post'] = 'UserController/store';
$route['admin/users/(:num)/delete']['post'] = 'UserController/delete/$1';


$route['admin/company/create']['post'] = 'CompanyController/create';
$route['admin/company/(:num)/update']['post'] = 'CompanyController/update/$1';


$route['admin/file/(:num)/delete']['post'] = 'FileController/delete/$1';
$route['admin/file/(:num)/download'] = 'FileController/download/$1';

$route['exames/auth']['post'] = 'ExamController/auth';

$route['exames/(:any)/show'] = 'ExamController/show/$1';
$route['exames/(:any)'] = 'ExamController/index/$1';
$route['exames/(:any)/(:any)/download'] = 'ExamController/download/$1/$2';
$route['exames/(:any)/(:any)/view'] = 'ExamController/view/$1/$2';