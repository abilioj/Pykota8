<?php

require '../config.php';

// lstUsuario.php frmUsuario.php controle/cad_Usuario.php
//$data = new Data();
$acao = Request::Do_REQUEST("acao", "");

switch ($acao):
    case "n":
        $id = Request::Do_GET("id", 0);
        header("location:../admin/frm/frmUsuario.php?id=" . $id . "&op=0");
        break;
    case "s":
        $id = Request::Do_POST("id", 0);
        $objUsuario = new Usuario();
        $objUsuario = copularObject('');
        $dao = new DaoUsuario();
        if ($objUsuario->getId() == 0):
            $objUsuario->setSenha(ToString::criptografaMD5(Request::Do_POST("senha", '')));
            if ($dao->inserir($objUsuario)):
                header("location:../admin/lst/lstUsuario.php?msg=1");
            else:
                header("location:../admin/lst/lstUsuario.php?msg=2");
            endif;

        else:
            if ($dao->alterar($objUsuario)):
                header("location:../admin/lst/lstUsuario.php?msg=1");
            else:
                header("location:../admin/lst/lstUsuario.php?msg=2");
            endif;
        endif;
        break;
    case "a":
        $id = Request::Do_GET("id", 0);
        header("location:../admin/frm/frmUsuario.php?id=" . $id . "&op=1");
        break;
    case "v":
        $id = Request::Do_GET("id", 0);
        header("location:../admin/frm/frmUsuario.php?id=" . $id . "&op=2");
        break;
    case "sc":
        $id = Request::Do_GET("id", 0);
        header("location:../admin/frm/frmUsuario.php?id=" . $id . "&op=3");
        break; //$op 3 Sua Conta 
    case "ai":
        $id = Request::Do_GET("id", 0);
        header("location:../admin/frm/frmUsuarioSC.php?id=" . $id . "&op=5");
        break; //$op 5 Alterar imagema
    case "as":
        $id = Request::Do_GET("id", 0);
        header("location:../admin/frm/frmUsuarioSC.php?id=" . $id . "&op=4");
        break; //$op 4 Alterar senha
    case "alteraSenha":
        $id = Request::Do_REQUEST("id", 0);
        $objUsuario = new Usuario();
        $objUsuario->setId($id);
        $senha = ToString::criptografaMD5(Request::Do_POST("senha", ''));
        $senhanova = Request::Do_POST("senhan", '');
        $senhanovaN = Request::Do_POST("senhanN", '');
        $dao = new DaoUsuario();
        $usu = $dao->selecionar($objUsuario);
        if ($senha == $usu->getSenha()):
            if ($senhanova == $senhanovaN):
                $senhanovaI = ToString::criptografaMD5($senhanova);
                if ($dao->fucaoAtualizarDefull(array($senhanovaI), array("senha_usuario"), "id_usuario={$id}")):
                    header("location:../admin/frm/frmUsuario.php?id=" . $id . "&op=3&msg=1");
                else:
                    header("location:../admin/frm/frmUsuario.php?id=" . $id . "&op=3&msg=2");
                endif;
            else:
                header("location:../admin/frm/frmUsuarioSC.php?id=" . $id . "&op=4&msg=3");
            endif;
        else:
            header("location:../admin/frm/frmUsuarioSC.php?id=" . $id . "&op=4&msg=4");
        endif;
        break;
    case "up":
        $id = Request::Do_POST("id", 0);
        $Dao = new DaoUsuario();
        $caminho = "../admin/assets/images/user/"; // Este é o caminho onde as imagens serão guardadas no servidor
        // Verificámos se o upload foi efectuado para o directório / caminho definido (juntámos também o nome da imagem)
        $eXT = strtolower(strrchr($_FILES['imagemupload']['name'], "."));
        $imagem = "user" . $id . $eXT;
        if (move_uploaded_file($_FILES['imagemupload']['tmp_name'], $caminho . $imagem)) {
            // Utilizámos agora a "magia" da Classe para criar os tamanhos necessários
            $resize_tamanho1 = new resize($caminho . $imagem);
            $resize_tamanho2 = new resize($caminho . $imagem);
            // Definimos as medidas que cada tamanho irá ter
            $resize_tamanho1->resizeImage(120, 120, 'crop');
            $resize_tamanho2->resizeImage(338, 338, 'crop');
            // Renomeámos a imagem para que seja possivel o mesmo nome ter vários tamanhos
            $tamanho1 = "t1_" . $imagem;
            $tamanho2 = "t2_" . $imagem;
            // Para finalizar guardámos a im0agem. Definimos o caminho, qual o nome e a qualidade
            if ($resize_tamanho1->saveImage($caminho . $tamanho1, 100) && $resize_tamanho2->saveImage($caminho . $tamanho2, 100)) {
                // O próximo passo é opcional mas recomendável.
                // Apagámos a imagem original
                unlink($caminho . $imagem);
                if ($Dao->fucaoAtualizarDefull(array($imagem), array("FOTO_USUARIO"), "ID_USUARIO={$id}")) {
                    header("location:../admin/frm/frmUsuario.php?id=" . $id . "&op=3&msg=1");
                } else {
                    header("location:../admin/frm/frmUsuario.php?id=" . $id . "&op=3&msg=2");
                }
            } else {
                header("location:../admin/frm/frmUsuarioSC.php?id=" . $id . "&op=5&msg=2");
            }
        } else {
            // No caso de erro no upload, podem redireccionar para outra página ou criar uma notificação
            header("location:../admin/frm/frmUsuarioSC.php?id=" . $id . "&op=5&msg=2");
        }
        break;
    case "l":
        header("location:../admin/lst/lstUsuario.php");
        break;
    case "d":
        $id = Request::Do_GET("id", 0);
        $un = new Usuario();
        $un->setId($id);
        $dao = new DaoUsuario();
        $u = $dao->selecionar($un);
        if ($u->getStatus() == 3) {
            $un->setStatus(2);
        } elseif ($u->getStatus() == 2) {
            $un->setStatus(3);
        }
        if ($dao->fucaoAtualizarDefull(array($un->getStatus()), array("ID_STATUS"), "ID_USUARIO={$un->getId()}")) {
            header("location:../admin/lst/lstUsuario.php?msg=1");
        } else {
            header("location:../admin/lst/lstUsuario.php?msg=2");
        }
        break;
    case "e":
        $id = Request::Do_GET("id", 0);
        $objUsuario = new Usuario();
        $objUE = new Usuario_Interno($id, 0);
        $dao = new DaoUsuario();
        $objUsuario->setId($id);
        $daoUE = new DaoUsuario_Interno();
        if ($dao->excluir($objUsuario)) {
            $daoUE->excluir($objUE);
            header("location:../admin/lst/lstUsuario.php?msg=1");
        } else {
            header("location:../admin/lst/lstUsuario.php?msg=2");
        }
        break;
    case "RS":
        /* $emaili = Request::Do_POST("email", "");
          $nome = "";
          $login = "";
          $senhanova = ToString::makeRandomPassword();
          $dao = new DaoUsuario();
          $IsOK = $dao->fucaoVerificarDefull(array("U.EMAIL_USUARIO = '" . $emaili . "'"));
          if ($IsOK):
          $conn = new Conexao();
          $conn->sql = "select ID_USUARIO,NOME_USUARIO,LOGIN_USUARIO,EMAIL_USUARIO from USUARIO where EMAIL_USUARIO = '{$emaili}';";
          $result = $conn->executaQuery();
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          $id = $row['ID_USUARIO'];
          $nome = $row['NOME_USUARIO'];
          $email = $row['EMAIL_USUARIO'];
          $login = $row['LOGIN_USUARIO'];
          }
          $message = "Olá {$nome}, redefinimos sua senha.<br /><br />
          <strong>Seu login é</strong>: {$login}<br /><br />
          <strong>Sua Nova Senha é</strong>: {$senhanova}<br /><br />
          <a href=''>Pyota</a><br /><br />
          Obrigado!<br /><br />
          <br /><br /><br />
          Esta é uma mensagem automática, por favor não responda!";
          $phpmailer = new phpmailerUtil();
          $phpmailer->I_Remetente_Destinatários($email, $nome, 1, null, null);
          $phpmailer->IIConfigMsg(true);
          $phpmailer->IIIDefineMensagem("Sua nova senha em App CASL", $message);
          $senhanovaI = ToString::criptografaMD5($senhanova);
          $conn->sql = "UPDATE USUARIO SET SENHA_USUARIO='{$senhanovaI}' WHERE ID_USUARIO='{$id}'";
          if ($conn->executaQuery()):
          if ($phpmailer->IVEnviar()) :
          header('location: ../admin/login.php?msg=6');
          else:
          header('location: ../admin/login.php?msg=7');
          endif;
          else:
          header('location: ../admin/login.php?msg=7');
          endif;
          else:
          header('location: ../admin/login.php?msg=8');
          endif; */
        break;
    case "logar":
        //$Service->Error_ReportingLogin();
        //abre o buffer para inicializar os cookies
        ob_start();
        //inicializa a sessao
        session_start();
        $login = Request::Do_POST("login", null);
        $senha = Request::Do_POST("senha", null);
        $configDB = new ConfigBDClass();
        $configAB = new ConfigADClass();
        $objAut = new ADauthUser();
        if ($configAB->getOp() != 0 && $login != 'admin'):
            //aqui autentico o usuario no servirdor AD se a conexão for de produção, vericado na configuração de conexao de Banco de dados
            if ($objAut->Authenticate_AD($login, $senha)):
                logarAD($login, $Service); //aqui loga no sistema pelo AD
            else:
                header('location: ../admin/login.php?msg=11');
            endif;
        else:
            if (validaUsers($login)):
                logar($login, $senha, $Service); //aqui loga no sistema local
            else:
                header('location: ../admin/login.php?msg=11');
            endif;
        endif;
        break;
    case "sair":
        session_start();
        logout($Service);
        header('location: ../admin/login.php?msg=5'); //../admin/login.php?msg=5
        break;
endswitch;

//seta todos dados da requisição do objeto usuario
function copularObject(string $prtLogin): Usuario {
    $data = new Data();
    $id = Request::Do_POST("id", 0);
    $objUsuario = new Usuario();
    $objUsuario->setId($id);
    $objUsuario->setNome(ToString::setToAspaSAspaD(Request::Do_POST("nome", $prtLogin)));
    $objUsuario->setLogin(ToString::setToAspaSAspaD(Request::Do_POST("login", $prtLogin)));
    $objUsuario->setSenha(Request::Do_POST("senha", "huana2020"));
    $objUsuario->setEmail(ToString::setToAspaSAspaD(Request::Do_POST("email", "")));
    $objUsuario->setTelefone(ToInputMask::InputFone(ToString::setToAspaSAspaD(Request::Do_POST("telefone", ""))));
    $objUsuario->setTipo(1);
    $objUsuario->setStatus(Request::Do_POST("status", 3));
    $objUsuario->setNivel(Request::Do_POST("nivel", 3));
    $objUsuario->setDatacadastro($data->data_atual_en());
    $objUsuario->setDataalteracao($data->data_atual_en());
    $objUsuario->setDataultimologin($data->dataEhora_atual_en());
    return $objUsuario;
}

//metodo que verifica se usuario de login esta viculado ao usuario do pykota 
function validaUsers(string $paramLogin): bool {
    $isOk = false;
    if ($paramLogin != "admin"):
        $objUser = new Users();
        $objDUser = new DaoUsers();
        $objDUE = new DaoUsuario_Interno();
        $objUser->setUsername($paramLogin);
        $objUser = $objDUser->selecionarIdPorNome($objUser);
        if ($objUser->getId() > 0):
            $objUE = new Usuario_Interno(0, $objUser->getId());
            $isOk = $objDUE->fucaoVerificarDefull(array("id_users=" . $objUE->getID_USERS()));
        endif;
    else:
        $isOk = true;
    endif;
    return $isOk;
}

function logarAD($paramLogin, $Service) {
    $dao = new DaoUsuario();
    $usu = new Usuario();
    $usuv = new Usuario();
    $usu->setLogin($paramLogin);
    $usuL = $dao->logar($usu);
    if ($usuL->getId() > 0):
        if ($usuL->getNivel() != 1 || $usuL->getNivel() != 2):
            if ($usuL->getStatus() != 1):
                if ($usuL->getStatus() != 2):
                    if (authUser($Service, $usuL->getId())):
                        header('location: ../admin/index.php');
                    endif;
                else:
                    header('location: ../admin/login.php?msg=3');
                endif;
            else:
                header('location: ../admin/login.php?msg=4');
            endif;
        else:
            header('location: ../admin/login.php?msg=4');
        endif;
    else:
        header('location: ../admin/login.php?msg=11');
    endif;
}

function logar($paramLogin, $paramSenha, $Service) {
    $dao = new DaoUsuario();
    $usu = new Usuario();
    $usuv = new Usuario();
    $usuv->setSenha(ToString::criptografaMD5($paramSenha));
    $usu->setLogin($paramLogin);
    $usuL = $dao->logar($usu);
    if ($usuL->getId() > 0):
        if ($usuL->getLogin() == $paramLogin)://verifica login
            if ($usuL->getSenha() == $usuv->getSenha())://verifica senha
                if ($usuL->getNivel() != 1 || $usuL->getNivel() != 2):
                    if ($usuL->getStatus() != 1):
                        if ($usuL->getStatus() != 2):
                            if (authUser($Service, $usuL->getId())):
                                header('location: ../admin/index.php');
                            endif;
                        else:
                            header('location: ../admin/login.php?msg=3');
                        endif;
                    else:
                        header('location: ../admin/login.php?msg=4');
                    endif;
                else:
                    header('location: ../admin/login.php?msg=4');
                endif;
            else:
                header('location: ../admin/login.php?msg=2');
            endif;
        else:
            header('location: ../admin/login.php?msg=1');
        endif;
    else:
        header('location: ../admin/login.php?msg=11');
    endif;
}
