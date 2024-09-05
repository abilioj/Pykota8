<?php

/**
 * Description of Request
 *
 * @author Abílio José G Ferreira
 */
class Request {

   public static function Do_GET($VAR, $resuDefat) {
      if (isset($_GET[$VAR])):
         if (empty($_GET[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_GET[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_POST($VAR, $resuDefat) {
      if (isset($_POST[$VAR])):
         if (empty($_POST[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_POST[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_REQUEST($VAR, $resuDefat) {
      if (isset($_REQUEST[$VAR])):
         if (empty($_REQUEST[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_REQUEST[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_GET_STRIMGcaracesp(string $VAR, string $resuDefat): string {
      if (isset($_GET[$VAR])):
         if (empty($_GET[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = htmlspecialchars(trim($_GET[$VAR]), ENT_QUOTES);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_POST_STRIMGcaracesp(string $VAR, string $resuDefat): string {
      if (isset($_POST[$VAR])):
         if (empty($_POST[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = htmlspecialchars(trim($_POST[$VAR]), ENT_QUOTES);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_DATA($VAR, $Opcoes) {
      $Data = new Data();
      $Service = new GetInfoSettings();
      switch ($Opcoes):
         case 'POST':
            if ($Service->getBrowserID() == 2):
               $resu = Request::Do_POST($VAR, $Data->getDataDefatPT_BR());
            else:
               $resu = Request::Do_POST($VAR, $Data->getDataDefat());
            endif;
            break;
         case 'GET':
            if ($Service->getBrowserID() == 2):
               $resu = Request::Do_GET($VAR, $Data->getDataDefatPT_BR());
            else:
               $resu = Request::Do_GET($VAR, $Data->getDataDefat());
            endif;
            break;
         default :
            $resu = null;
            break;
      endswitch;
      return $resu;
   }

   public static function Do_COOKIE($VAR, $resuDefat) {
      if (isset($_COOKIE[$VAR])):
         if (empty($_COOKIE[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_COOKIE[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_SESSION($VAR, $resuDefat) {
      if (isset($_SESSION[$VAR])):
         if (empty($_SESSION[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_SESSION[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

}
