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
$view->display('filter.tpl.php');

?>