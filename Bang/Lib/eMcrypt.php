<?php

namespace Bang\Lib;

/**
 * @author Bang
 */
class eMcrypt {

    public static function Encode($key, $data) {
        $hash_string = $key;

        $hash = hash('SHA384', $hash_string, true);
        $app_cc_aes_key = substr($hash, 0, 32);
        $app_cc_aes_iv = substr($hash, 32, 16);

        $padding = 16 - (strlen($data) % 16);
        $data .= str_repeat(chr($padding), $padding);
        $encrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $app_cc_aes_key, $data, MCRYPT_MODE_CBC, $app_cc_aes_iv);

        $encrypt_text = base64_encode($encrypt);
        return $encrypt_text;
    }

    public static function Decode($key, $encrypt_in_base64) {
        $encrypt = base64_decode($encrypt_in_base64);
        $hash_string = $key;
        $hash = hash('SHA384', $hash_string, true);
        $app_cc_aes_key = substr($hash, 0, 32);
        $app_cc_aes_iv = substr($hash, 32, 16);


        $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $app_cc_aes_key, $encrypt, MCRYPT_MODE_CBC, $app_cc_aes_iv);
        $padding = ord($data[strlen($data) - 1]);
        $decrypt_text = substr($data, 0, -$padding);
        return $decrypt_text;
    }

}
