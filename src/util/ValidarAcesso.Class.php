 <?php

/**
 * Description of ValidarAcesso
 *
 * @author Abílio José G Ferreira
 */
class ValidarAcesso {

   function __construct() {

   }

   public function validarAcessoPage($NivelArrays, $link, $nivelUsu) {
      $linkGO = TRUE;
      foreach ($NivelArrays as $n):
         if ($n == $nivelUsu):
            $linkGO = FALSE;
            break;
         endif;
      endforeach;
      if ($linkGO):
         header("location: {$link}");
         return;
      else:
         return;
      endif;
   }

}
