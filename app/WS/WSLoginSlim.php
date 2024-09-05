<?php

ini_set('default_charset', 'UTF-8');
require './config_json.php';

//class
$conn = new Conexao();
$sqlR = new SqlRules();
$dao = new DaoUsuario();
$usu = new Usuario();
$usuv = new Usuario();
$MSGobg = new Menssagem();

//variavel 
$IsOK = false;
$sql_tb = '';
$msg = 0;
$msgText = "";
$row = 0;
$resuDefat = 0;
$dados = null;
$senha = Request::Do_POST("senha", null);
$login = Request::Do_POST("login", null);

if($login != NULL || $login == ''):
    $usu->setLogin($login);
	$usu->setSenha(ToString::criptografaMD5($senha));
        $usuv->setSenha(ToString::criptografaMD5($senha));
	$usuL = $dao->logar($usu);
        if ($usuL->getLogin() == $login) {//verifica login
            if ($usuL->getSenha() == $usuv->getSenha()) {//verifica senha
                if ($usuL->getNivel() != 1 || $usuL->getNivel() != 2) {
                    if ($usuL->getStatus() != 1) {
                        if ($usuL->getStatus() != 2) {
                            $IsOK = true;
                        } else {
                            $msg=4;
                        }
                    } else {
                        $msg=7;
                    }
                } else {
                    $msg=3;
                }
            } else {
                $msg=2;
            }
        } else {
            $msg=1;
        }
else:
endif;/**/
$msgText = $MSGobg->MenssagemToWS($msg);
$dados = [
    'senha' => $senha
        , 'login' => $login
        , 'msg' => $msg
        , 'msgtext' => $msgText
        , 'isOk' => $IsOK
        ];
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
