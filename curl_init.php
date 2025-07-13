<?php

/**
 * PHP curl 
 * [GET] | [POST] | [DELETE] | [PUT] | [OPTIONS]
 * Copyright (c) 2025 CodeVoyagersT
 */

class TronCurl {

    public static function exec($url, $method, $header = array(), $params = array()) {
        $ch = curl_init();

        switch($method) {
            case "GET":
                if (strrpos($url, "?") === false) {
                    $url .= '?' . http_build_query($params);
                }
                break;
            case "POST": 
                curl_setopt($ch, CURLOPT_POST, TRUE);
                if (sizeof($params) > 0) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json.encode($params));
                }
                break;
            default: 
                echo "1212121";
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($$params)); 
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);


        $header = trim(substr($response, 0, $info['header_size']));
        $body = substr($response, $info['header_size']);

        return array('status' => $info['http_code'], 'header' => $header, 'data' =>json_decode($body));
    }

    public static function get($url, $header = array(), $obj = array()) {
        return TronCurl::exec($url, "GET", $header, $obj);
    }

    public static function post($url, $header = array(), $obj = array()) {
        return TronCurl::exec($url, "POST", $header, $obj);
    }

    public static function put($url, $header = array(), $obj = array()) {
        return TronCurl::exec($url, "PUT", $header, $obj);
    }

    public static function delete($url, $header = array(), $obj = array()) {
        return TronCurl::exec($url, "DELETE", $header, $obj);
    }
}

