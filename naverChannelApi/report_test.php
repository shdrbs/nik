<?php
include $_SERVER['DOCUMENT_ROOT'] . "/nik/function.php";

ini_set("default_socket_timeout", 30);
require_once 'restapi.php';

$config = parse_ini_file("config.ini");
tt("config", $config);

function debug($obj, $detail = false)
{
    if (is_array($obj)) {
        echo "size : " . count($obj) . "\n";
    }
    if ($detail) {
        print_r($obj);
    }
}

// #. detail log
$DEBUG = false;

$config['CUSTOMER_ID'] = $_REQUEST['master_id'];

$api = new RestApi($config['BASE_URL'], $config['API_KEY'], $config['SECRET_KEY'], $config['CUSTOMER_ID']);

$url = "/ncc/channels";
$result = $api->GET($url , $data , $param );

tt("naver_bizChannel", $result);
?>