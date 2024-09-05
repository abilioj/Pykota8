<?php

$confHtml = new ConfigHTML();

$tpl->lang = $confHtml->getLang();
$tpl->titlepage = $confHtml->getTitlepage();
$tpl->titlepagemenu = $confHtml->getTitlepage();
$tpl->metaCharset = $confHtml->getMetaCharset();
$tpl->metaHttpEquiv = $confHtml->getMetaHttpEquiv();
$tpl->metaViewport = $confHtml->getMetaViewport();

//<!-- Body - ADICIONE A CLASS Sidedar-colapso PARA ESCONDER A BARRA LATERAL ANTES DE CARREGAR O SITE -->

/*

  session_start();
  if ( isset( $_SESSION["sessiontime"] ) ) {
  if ($_SESSION["sessiontime"] < time() ) {
  session_unset();
  //Redireciona para login
  } else {
  //echo 'Logado ainda!';
  //Seta mais tempo 60 segundos
  $_SESSION["sessiontime"] = time() + 60;
  }
  } else {
  session_unset();
  //Redireciona para login
  header("Location: ".$UrlLink."");
  }

  /////////////////////////////////////////////////////

  ini_set('session.use_trans_sid', 0);

  if (!isset($_SESSION['nome'])){
  $_SESSION['nome']="convidado";
  }

  if ($_SESSION['nome']!="convidado"){
  $contador = time();

  if (!isset($_SESSION['contagem'])){
  $_SESSION['contagem']= $contador;
  }

  if ($contagem - $_SESSION['contagem'] >= 3600 ){
  header("Location: ".$UrlLink."");
  }

  $_SESSION['contagem']= $contador;
  }


//função para redirecionamento de URL..
function redireciona($link){
if ($link==-1){
echo" <script>history.go(-1);</script>";
}else{
echo" <script>document.location.href='$link'</script>";
}
}

//$link = 'index.php?pagina=teste'; // especifica o endereço
//redireciona($link); // chama a função

 */
