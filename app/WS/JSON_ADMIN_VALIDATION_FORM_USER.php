<?php

require './config_json.php';

//Classes de utilização
$daoUsu = new DaoUsuario();

//vERIAVEIS
$Dados = null;
$IsOKL = false;
$IsOKE = false;
$login = Request::Do_POST("login", null);
$email = Request::Do_POST("email", null);

if ($login != null):
   if ($daoUsu->fucaoVerificarDefull(array("u.login_usuario = '{$login}'"))):
      $IsOKL = TRUE;
   else:
      $IsOKL = FALSE;
   endif;
endif;

if ($email != null):
   if ($daoUsu->fucaoVerificarDefull(array("u.email_usuario = '{$email}'"))):
      $IsOKE = TRUE;
   else:
      $IsOKE = FALSE;
   endif;
endif;

$Dados["Result"][] = array("ResultL" => $IsOKL, "ResultE" => $IsOKE);
echo json_encode($Dados, JSON_PRETTY_PRINT);
