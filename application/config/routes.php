<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "C_auth";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'C_auth';
$route['home'] = 'C_home';

// APBD
$route['apbd'] = 'C_apbd';
$route['apbd/filter'] = 'C_filter';
$route['apbd/filter/(:any)'] = 'C_filter/$1';
$route['apbd/hapus'] = 'C_delete';
$route['apbd/hapus/(:any)'] = 'C_delete/$1';
$route['apbd/kontak'] = 'C_pic';
$route['apbd/kontak/(:any)'] = 'C_pic/$1';
$route['apbd/update'] = 'C_update';
$route['apbd/update/(:any)'] = 'C_update/$1';
$route['apbd/hapus'] = 'C_delete';
$route['apbd/hapus/(:any)'] = 'C_delete/$1';
$route['apbd/update'] = 'C_update';
$route['apbd/(:any)'] = 'C_apbd/$1';

// PELABUHAN
$route['pelabuhan'] = 'pelabuhan/C_pelabuhan';
$route['pelabuhan/filter'] = 'pelabuhan/C_filter';
$route['pelabuhan/filter/(:any)'] = 'pelabuhan/C_filter/$1';
$route['pelabuhan/hapus'] = 'pelabuhan/C_delete';
$route['pelabuhan/hapus/(:any)'] = 'pelabuhan/C_delete/$1';
$route['pelabuhan/update'] = 'pelabuhan/C_update';
$route['pelabuhan/update/(:any)'] = 'pelabuhan/C_update/$1';
$route['pelabuhan/(:any)'] = 'pelabuhan/C_pelabuhan/$1';

//KELISTRIKAN
$route['kelistrikan'] = 'kelistrikan/C_kelistrikan';
$route['kelistrikan/filter'] = 'kelistrikan/C_filter';
$route['kelistrikan/filter/(:any)'] = 'kelistrikan/C_filter/$1';
$route['kelistrikan/hapus'] = 'kelistrikan/C_delete';
$route['kelistrikan/hapus/(:any)'] = 'kelistrikan/C_delete/$1';
$route['kelistrikan/update'] = 'kelistrikan/C_update';
$route['kelistrikan/update/(:any)'] = 'kelistrikan/C_update/$1';
$route['kelistrikan/(:any)'] = 'kelistrikan/C_kelistrikan/$1';

//KENDARAAN
$route['kendaraan'] = 'kendaraan/C_kendaraan';
$route['kendaraan/filter'] = 'kendaraan/C_filter';
$route['kendaraan/filter/(:any)'] = 'kendaraan/C_filter/$1';
$route['kendaraan/hapus'] = 'kendaraan/C_delete';
$route['kendaraan/hapus/(:any)'] = 'kendaraan/C_delete/$1';
$route['kendaraan/update'] = 'kendaraan/C_update';
$route['kendaraan/update/(:any)'] = 'kendaraan/C_update/$1';
$route['kendaraan/(:any)'] = 'kendaraan/C_kendaraan/$1';

//PENERBANGAN
$route['penerbangan'] = 'penerbangan/C_penerbangan';
$route['penerbangan/filter'] = 'penerbangan/C_filter';
$route['penerbangan/filter/(:any)'] = 'penerbangan/C_filter/$1';
$route['penerbangan/hapus'] = 'penerbangan/C_delete';
$route['penerbangan/hapus/(:any)'] = 'penerbangan/C_delete/$1';
$route['penerbangan/update'] = 'penerbangan/C_update';
$route['penerbangan/update/(:any)'] = 'penerbangan/C_update/$1';
$route['penerbangan/(:any)'] = 'penerbangan/C_penerbangan/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */