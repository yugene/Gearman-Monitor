<?php

require_once('_init.php');

$options = array();
$pageUri = "{$_SERVER['PHP_SELF']}?";

if (isset($_REQUEST['filterServers']) && is_array($_REQUEST['filterServers']))
{
    $options['filterServers'] = $_REQUEST['filterServers'];
    foreach ($options['filterServers'] as $filterServer)
    {
        $pageUri .= 'filterServers[]=' . intval($filterServer) . '&';
    }
}
if (isset($_REQUEST['sort']) && strlen(trim($_REQUEST['sort'])) > 0)
{
    $options['sort'] = $_REQUEST['sort'];
}

$serverList = new GA_ServerList($options);
$serverList->addServers($cfgServers);

$view->versionData = $serverList->getVersionData();
$view->errors = $serverList->getErrors();
$view->pageUri = $pageUri;

$view->display('servers.tpl.php');

?>