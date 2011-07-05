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
if (isset($_REQUEST['filterName']) && strlen(trim($_REQUEST['filterName'])) > 0)
{
    $options['filterName'] = $_REQUEST['filterName'];
    $pageUri .= "filterName=" . urlencode($_REQUEST['filterName']) . '&';
}
if (isset($_REQUEST['sort']) && strlen(trim($_REQUEST['sort'])) > 0)
{
    $options['sort'] = $_REQUEST['sort'];
}

$serverList = new GA_ServerList($options);
$serverList->addServers($cfgServers);

$view->workersData = $serverList->getWorkersData();
$view->errors = $serverList->getErrors();
$view->pageUri = $pageUri;

$view->display('workers.tpl.php');

?>