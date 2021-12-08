<?php

class Smart_IP {

    public $null = '-';
    public $user_ip = '';
    public $cf = false;
    public $valid = false;

/**
 * Get real user IP address
 *
 * @return string IP address.
 */
    public function ip() {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ".") > 0 && strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ",") > 0) {
                $ip = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
                $this->user_ip = trim($ip[0]);
            } elseif (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ".") > 0 && strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ",") === false) {
                $this->user_ip = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
            }
        }
        if (!isset($this->user_ip)) {
            if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                $this->user_ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $this->cf = true;
            } else {
                $this->user_ip = $_SERVER["REMOTE_ADDR"];
            }
        }
       if($this->validate() == true){
           return $this->user_ip;
       }
    }

/**
 * Validate IP address
 *
 * @return bool If IPv4 or IPv6 correct return TRUE
 */    
    public function validate() {
        if (!filter_var($this->user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) && !filter_var($this->user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $this->user_ip = $this->null;
            $this->valid = false;
            return $this->valid;
        } else {
            $this->valid = true;
            return $this->valid;
        }
    }

}

$test = new Smart_IP();
$test->ip();
