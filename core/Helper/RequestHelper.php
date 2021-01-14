<?php

class RequestHelper{

    public static function post($param){
        if(isset($_POST[$param]))
            return htmlspecialchars($_POST[$param]);
        else    
            return "";
    }

    
    public static function get($param){
        if(isset($_GET[$param]))
            return htmlspecialchars($_GET[$param]);
        else    
            return "";
    }


    
    public static function passwordEncode($password){
        return hash('sha256', $password);
    }
    
    
    public static function encodeUrlParam($param){
        return rawurlencode($param);
    }
    
    public static function decodeUrlParam($param){
        return rawurldecode($param);
    }


}