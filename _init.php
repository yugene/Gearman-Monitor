<?php

require_once('_config.php');
require_once('classes/ServerList.php');
require_once('classes/View.php');
include_once('vendor/autoload.php');

$view = new GA_View();
$view->setTemplateDir('templates');
$view->servers = $cfgServers;
