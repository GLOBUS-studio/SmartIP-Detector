<?php

/**
 * Class Smart_IP
 *
 * This class is designed to retrieve and validate the real IP address of a user.
 */
class Smart_IP {

    /**
     * @var string $null Default value for an invalid IP address.
     */
    private $null = '-';

    /**
     * @var string|null $user_ip The user's IP address.
     */
    private $user_ip = null;

    /**
     * @var bool $cf Flag indicating whether the IP was obtained from Cloudflare.
     */
    private $cf = false;

    /**
     * @var bool $valid Flag indicating whether the IP address is valid.
     */
    private $valid = false;

    /**
     * Retrieves the real IP address of a user.
     *
     * @return string|null The IP address.
     */
    public function ip() {
        // Check for the presence of the 'X-Forwarded-For' header.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Splitting the string that contains possible IP addresses.
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $this->user_ip = trim($ips[0]); // Taking the first from the list.
        } elseif (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            // Get IP from Cloudflare.
            $this->user_ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $this->cf = true;
        } else {
            // Otherwise, just take the remote address.
            $this->user_ip = $_SERVER["REMOTE_ADDR"];
        }

        return $this->validate() ? $this->user_ip : $this->null;
    }

    /**
     * Validates the IP address (IPv4 or IPv6).
     *
     * @return bool Returns TRUE if the IP address is valid.
     */
    private function validate() {
        if (!filter_var($this->user_ip, FILTER_VALIDATE_IP)) {
            // If the IP fails validation, set it to null and return false.
            $this->user_ip = $this->null;
            $this->valid = false;
        } else {
            // If the IP is valid, set to true.
            $this->valid = true;
        }

        return $this->valid;
    }

    /**
     * Returns information about whether the IP was obtained through Cloudflare.
     *
     * @return bool
     */
    public function isCloudflare() {
        return $this->cf;
    }
}

// Example of using the class.
$test = new Smart_IP();
echo $test->ip();
