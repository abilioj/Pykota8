<?php
/**
 * Description of Cryptography
 *
 * @author Abílio José
 */
class Cryptography {
    
    //criptografa em MD5
    public static function CryptographyMD5($string) {
        return htmlspecialchars(MD5(trim($string)), ENT_QUOTES);
    }

    //criptografa em BASE64
    public static function criptografaBASE64($string) {
        return htmlspecialchars(base64_encode(trim($string)), ENT_QUOTES);
    }

    //descriptografa em BASE64
    public static function descriptografaBASE64($string) {
        return htmlspecialchars(base64_decode(trim($string)), ENT_QUOTES);
    }

}
