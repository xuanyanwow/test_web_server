<?php

$test_web_server_bin_path = dirname(__FILE__);
const HOST_FILE = 'C:\Windows\System32\drivers\etc\hosts';

require_once dirname(__FILE__)."/../vendor/autoload.php";

use Siam\CommandLine;
use Siam\HostsManage;
use Siam\TestWebServer\NatappHelperService;

$args = CommandLine::parseArgs();


$natapp = NatappHelperService::get_hosts();

$hm = new HostsManage(HOST_FILE);
$hosts = $hm->getHosts();
$hosts = \Siam\TestWebServer\HostsService::replace( $hosts, $natapp, "127.0.0.1" );
$hm->setHosts($hosts);
unset($hm);


$host = $natapp;
$port = "80";
$root = getcwd();
$php_path = $args['php'] ?? "php";

$command = sprintf(
    '%s -S %s:%d -t %s',
    $php_path,
    $host,
    $port,
    escapeshellarg($root)
);

passthru($command);