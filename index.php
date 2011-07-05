<?php

require_once('_init.php');

if (isset($_REQUEST['action']) && in_array($_REQUEST['action'], array('queue', 'workers', 'servers')))
{
    $action = $_REQUEST['action'];
}
else
{
    $action = 'queue';
}

$view->action = $action;
$view->gearmanClassExists = class_exists('Net_Gearman_Manager', true);
$view->display('index.tpl.php');

?>