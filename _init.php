<?php

require_once('_config.php');
require_once('classes/ServerList.php');
require_once('classes/View.php');
@include_once('Net/Gearman/Manager.php');

function d($var = null)
{
    echo '<pre>';
    if (! is_null($var))
    {
        var_dump($var);
    }
    else
    {
        debug_print_backtrace();
    }
    echo '</pre>';
}

$view = new GA_View();
$view->setTemplateDir('templates');
$view->servers = $cfgServers;

?>