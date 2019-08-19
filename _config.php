<?php

/**
 * Gearman Monitor configuration file
 *
 * The following server fields are available:
 *  - address: Gearman server address, hostname and port
 *  - name: Gearman server name to display in Gearman Monitor interface
 *
 * Example:
 * $cfgServers[$i]['address'] = '192.168.0.10:4730';
 * $cfgServers[$i]['name'] = 'Gearman server 1';
 * ++ $i;
 *
 * $cfgServers[$i]['address'] = '192.168.1.1:7003';
 * $cfgServers[$i]['name'] = 'Gearman server 2';
 * ++ $i;
 */

$i          = 0;
$cfgServers = [];

$cfgServers[$i]['address'] = '127.0.0.1';
$cfgServers[$i]['name']    = '';
++$i;

/**
 * Graph time to refresh JS
 */
$jsGraphTime = 2000; //two secondis
/**
 * Table time to refresh JS
 */
$jsTableTime = 5000;
