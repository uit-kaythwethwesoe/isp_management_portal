<?php
   
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 32; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
        
    $timestamp        = time();
    $nonce            = $randomString;

    $api_url          = $details->kbz_redirecct;
    $m_code           = $details->kbz_m_code;
    $appid            = $details->kbz_appid;
    $key              = $details->kbz_key;
        
    $prepay_id        = $_GET['prepay_id'];
    $c_time           = $timestamp;
    $nonce_str        = $nonce;
    
    $stringA = "appid=".$appid."&merch_code=".$m_code."&nonce_str=".$nonce_str."&prepay_id=".$prepay_id."&timestamp=".$c_time;
    $stringToSign = $stringA."&key=".$key;
    
    $signature = hash('sha256', $stringToSign);
    
    $url = $api_url."appid=".$appid."&merch_code=".$m_code."&nonce_str=".$nonce_str."&prepay_id=".$prepay_id."&timestamp=".$c_time."&sign=".$signature;
    
    echo '<script>window.location.href = "'.$url.'";</script>';
?>