<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('user_agent','pagination','session','form_validation');
$autoload['drivers'] = array();
$autoload['helper'] = array('custom','html','url','form','download');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('Admin_model','Common_db_model',"Sendmon_model");
