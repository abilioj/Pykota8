<?php

/**
 * Description of ArrayUrl
 *
 * @author Abílio José G Ferreira
 */
class ArrayUrl {

   private $ArrayUrl;

   function __construct() {

   }

   function getArrayUrl() {
      return $this->ArrayUrl;
   }

   public function Array_URL($dir, $orden, $string) {
      $int = (int) 0;
      $files = scandir($dir, $orden);
      foreach ($files as $val):
         if (ToString::VerifecaParteDeString($val, $string)):
            echo '<a href="./' . $val . '">' . $val . '</a> <br/>';
         endif;
         $this->ArrayUrl[$int] = array($val);
         $int++;
      endforeach;
   }

}

/*
 modo de Uso

 $urlArray = new ArrayUrl();
 $arrayUrl = $urlArray->Array_URL("./", 0, '.php');

 */