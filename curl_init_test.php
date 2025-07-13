<?php

$curl = require_once __DIR__ . '/curl_init.php';


/**
 * GET
 */
$res = TronCurl::get("http://jsonplaceholder.typicode.com/posts", $header= array(), $params = array());
print_r($res);

$res = TronCurl::get("http://jsonplaceholder.typicode.com/posts/2", $header= array(), $params = array());
print_r($res);


/**
 * POST
 */
$params = array("userId" => 1, "title" => "test", "body" => "test001");
$res = TronCurl::post("http://jsonplaceholder.typicode.com/posts", [], []);
print_r($res);
