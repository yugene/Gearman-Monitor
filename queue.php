<?php
ini_set('display_errors', 1);

require_once '_init.php';

$options = [];
$pageUri = "{$_SERVER['PHP_SELF']}?";

if (isset($_REQUEST['filterServers']) && is_array($_REQUEST['filterServers'])) {
    $options['filterServers'] = $_REQUEST['filterServers'];
    foreach ($options['filterServers'] as $filterServer) {
        $pageUri .= 'filterServers[]=' . intval($filterServer) . '&';
    }
}
if (isset($_REQUEST['filterName']) && strlen(trim($_REQUEST['filterName'])) > 0) {
    $options['filterName'] = $_REQUEST['filterName'];
    $pageUri .= "filterName=" . urlencode($_REQUEST['filterName']) . '&';
}
if (isset($_REQUEST['sort']) && strlen(trim($_REQUEST['sort'])) > 0) {
    $options['sort'] = $_REQUEST['sort'];
}

if (isset($_REQUEST['groupby']) && strlen(trim($_REQUEST['groupby'])) > 0) {
    $options['groupby'] = $_REQUEST['groupby'];
}

$serverList = new GA_ServerList($options);
$serverList->addServers($cfgServers);

$functionData = $serverList->getFunctionData();

$view->versionData = $serverList->getVersionData();

$view->errors  = $serverList->getErrors();
$view->pageUri = $pageUri;

foreach ($functionData as $k => $v) {
    $functionData[$k]['id_key'] = str_replace([' ', '/', '\\', ':', ';', ',', '"', "'", '+', '-', '?'], '_', $v['server'] . $v['name']);
}

if (isset($_REQUEST['json'])) {
    $report = new GA_Report();
    header('Content-Type: application/json');
    echo json_encode([
        'total' => $report->total($functionData),
        'data'  => $functionData,
    ]);
    die();
}
$view->functionData = $functionData;

$view->display('queue.tpl.php');
