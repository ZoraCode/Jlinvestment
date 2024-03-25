<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* kcp */
$route['pay/kcp'] = 'kcppayment/Main/index';
$route['pay/kcp/order'] = 'kcppayment/Main/order';

$route[admmng] = 'mng/index';
$route[admmng.'/(:any)'] = 'Mng/$1';
$route[admmng.'/(:any)/(:num)'] = 'Mng/$1/$2';


$route['(:any)'] = 'Main/$1';
$route['(:any)/(:num)'] = 'Main/$1/$2';
$route['(:any)/(:num)/(:num)'] = 'Main/$1/$2/$3';

$route['popup'] = 'Main/popup';
$route['popup/(:num)'] = 'Main/popup/$1';

$route['member/superadminchangepasswordpAdm2018'] = 'Member/findpwadm';
$route['member/(:any)'] = 'Member/$1';
$route['proc/(:any)'] = 'Proc/$1';

//$route['payment'] = 'Main/index';
$route['payment/(:any)'] = 'Payment/$1';
$route['payment/(:any)/(:any)'] = 'Payment/$1/$2';

// api
$route['api/(:any)'] = 'api/$1';
$route['attach/(:any)/down/(:any)'] = 'Mng/down/$1/$2';

$route['default_controller'] = 'Main';
$route['404_override'] = 'Main/error';
$route['translate_uri_dashes'] = FALSE;
