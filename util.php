<?php

function getSign($params, $appKey) {
    $pairs = [];
    $setParams = [];
    foreach ($params as $key => $value) {
        if (empty($value)) {
            continue;
        }
        if (in_array($key, ['sign'])) {
            continue;
        }
        $setParams[$key] = $value;
    }
    ksort($setParams);
    foreach ($setParams as $key => $value) {
        $pairs[] = $key . "=" . $value;
    }
    $string = implode('&', $pairs) . $appKey;
    return sha1($string);
}

/**
 * curl post请求
 * @params 输入的参数
 * @param $params
 * @param $url
 * @param $timout
 * @return bool|string
 */
function curl_post($params, $url, $timout){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timout);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:'.'application/x-www-form-urlencoded;charset=UTF-8'));
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function getMillisecond() {
    list($t1, $t2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
}