<?php

require_once('_init.php');

$view->gearmanClassExists = class_exists('Net_Gearman_Manager', true);
$view->display('index.tpl.php');

?>