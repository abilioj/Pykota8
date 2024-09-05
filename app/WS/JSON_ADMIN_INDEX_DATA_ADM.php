<?php
/*
 * ws pra alimenta a lista de usuario da pagina home do sistema
 * lista todos os usuarios
 */
ini_set('default_charset', 'UTF-8');
require './config_json.php';

$conn = new Conexao();

//Class
$sqlR = new SqlRules();

//variavel 
$sql_tb = '';
$row = 0;
$conditions = null;
$arrayWhere = null;
$result = 0;
$dados = null;
$idg = (int) Request::Do_POST('idg', $resuDefat);
$idu = (int) Request::Do_POST('idu', $resuDefat);
$idp = (int) Request::Do_POST('idp', $resuDefat);

if ($idg != null && $idg > 0):
    $arrayWhere[] = "g.id = " . $idg . "";
endif;
if ($idp != null && $idp > 0):
    $arrayWhere[] = "p.id = " . $idp . "";
endif;

//sql home
if ($idu != null && $idu > 0):
    $arrayWhere[] = "cu.pkuser = " . $idu . "";
endif;
$sql_tb = $sqlR->sqlHomeUsersII($arrayWhere);
$conn->sql = $sql_tb;

//execlute
$result = $conn->fetchArrayAssoc();
$row = $conn->linhasPesquisadas("select");
if ($result != null):
    foreach ($result as $r):
        $dados["data"][] = array($r["idg"], $r["idu"], $r["idp"], $r["usuario"], ($r["grupo"]=='0') ? '<b>Sem Vinculação Em Grupo</b>': $r["grupo"], $r["impressora"],$r['limite'],$r['cota']);
    endforeach;
else:
    $dados["data"] = null;
endif;

//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
