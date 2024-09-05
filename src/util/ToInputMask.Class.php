<?php

/**
 * Description of ToInputMask
 *
 * @author Abílio José G Ferreira
 */
class ToInputMask {

   function __construct() {

   }

   public static function InputFone($param) {
      $text1 = ToString::TrocarCaracte("(", "", $param);
      $text2 = ToString::TrocarCaracte(")", "", $text1);
      $textFIM = ToString::TrocarCaracte("-", "", $text2);
      return $textFIM;
   }

   public static function InputCpf($param) {
      $text1 = ToString::TrocarCaracte(".", "", $param);
      $textFIM = ToString::TrocarCaracte("-", "", $text1);
      return $textFIM;
   }

   public static function InputCnpf($param) {
      $text1 = ToString::TrocarCaracte(".", "", $param);
      $text2 = ToString::TrocarCaracte("/", "", $text1);
      $textFIM = ToString::TrocarCaracte("-", "", $text2);
      return $textFIM;
   }

   public static function InputCep($param) {
      $textFIM = ToString::TrocarCaracte("-", "", $param);
      return $textFIM;
   }
   
   public static function InputCoin($param) {
      $textFIM = ToString::TrocarCaracte("R$:", "", $param);
      return $textFIM;
   }
   
}
