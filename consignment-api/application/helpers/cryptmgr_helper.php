<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  function crypto_rand_secure($min, $max){
      $range = $max - $min;
      if ($range < 1) return $min; // not so random...
      $log = ceil(log($range, 2));
      $bytes = (int) ($log / 8) + 1; // length in bytes
      $bits = (int) $log + 1; // length in bits
      $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
      do {
          $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
          $rnd = $rnd & $filter; // discard irrelevant bits
      } while ($rnd > $range);
      return $min + $rnd;
  }

  function crypt_generateRandomString($length){
      $token = "";
      $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
      $codeAlphabet.= "0123456789";
      $max = strlen($codeAlphabet); // edited

      for ($i=0; $i < $length; $i++) {
          $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
      }

      return $token;
  }

  function crypt_generateSalt($length){
      $token = "";
      $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
      $codeAlphabet.= "0123456789";
      $codeAlphabet.= "!@#$^&*_+-=";
      $max = strlen($codeAlphabet); // edited

      for ($i=0; $i < $length; $i++) {
          $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
      }

      return $token;
  }

  function crypt_hashPassword($password,$salt,$hash=TRUE){
      $hashMD5=md5($password);
      $hashSHA1=sha1($hashMD5);

      $unhashedPassword=substr($salt,0,8).$hashSHA1.substr($salt,-8);
      $hashedPassword=password_hash($unhashedPassword,PASSWORD_DEFAULT);

      if($hash==TRUE){
        $response=$hashedPassword;
      }else{
        $response=$unhashedPassword;
      }

      return $response;
  }

  function crypt_generateSaltedPassword($password){
      $salt=crypt_generateSalt(32);
      $hashedPassword=crypt_hashPassword($password,$salt,TRUE);

      $response=(object)array(
        "g_salt"      => $salt,
        "g_password"  => $hashedPassword
      );

      return $response;
  }

?>
