<?php
require 'environment.php';
$config = array();
if (ENVIRONMENT == 'development') {
    define("BASE_URL", "http://localhost:8080/");
    $config['dbname'] = 'sql10393879';
    $config['host'] = 'sql10.freemysqlhosting.net';
    $config['dbuser'] = 'sql10393879';
    $config['dbpass'] = 'dRc9CtTIbS';
} else {
    define("BASE_URL", "http://meusite.com.br/");
    $config['dbname'] = 'sql10393879';
    $config['host'] = 'sql10.freemysqlhosting.net';
    $config['dbuser'] = 'sql10393879';
    $config['dbpass'] = 'dRc9CtTIbS';
}
global $db;
try {
    $db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'] . ";charset=utf8", $config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
    echo "ERRO: " . $e->getMessage();
    exit;
}
