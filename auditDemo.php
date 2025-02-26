<?php

define("APP_ID", "请输入appId");
define("APP_SECRET", "请输入appKey");
define("BUSINESS_ID", "请输入businessID");
define("API_URL", "https://api.botsmart.cn/v1/check/send");
define("API_TIMEOUT", 10);
require("util.php");


function main(){
    $params = array();
    $params["app_id"] = APP_ID;
    $params["business_id"] = BUSINESS_ID;
    $params["timestamp"] = getMillisecond();
    $params["unique_id"] = "123456";
    $params["data"] = "请输入审核内容";
    $params["signature"] = getSign( $params,APP_SECRET);
    var_dump($params);
    $result = curl_post($params, API_URL, API_TIMEOUT);
    if($result === FALSE){
        echo "failed";
    }else{
        var_dump($result);
    }
}

main();
