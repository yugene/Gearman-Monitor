<?php

require_once '_config.php';
require_once 'classes/ServerList.php';
require_once 'classes/Report.php';
require_once 'classes/View.php';
include_once 'vendor/autoload.php';

$view = new GA_View();
$view->setTemplateDir('templates');
$view->servers = $cfgServers;

if (isset($_REQUEST['action']) && in_array($_REQUEST['action'], array('queue', 'workers', 'servers'))) {
    $action = $_REQUEST['action'];
} else {
    $action = 'queue';
}

if (isset($_REQUEST['sort'])) {
    $view->sort = $_REQUEST['sort'];
}
if (isset($_REQUEST['dir'])) {
    $view->dir = $_REQUEST['dir'];
}
if (isset($_REQUEST['filterName'])) {
    $view->filterName = $_REQUEST['filterName'];
}
$view->filterServers = [];
if (isset($_REQUEST['filterServers'])) {
    $view->filterServers = $_REQUEST['filterServers'];
}

$view->action = $action;
