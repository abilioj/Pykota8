<?php

ini_set('default_charset', 'UTF-8');
require './config_json.php';

$conn = new Conexao();

//variavel Class
$sqlR = new SqlRules();

//variavel 
$sql_tb = '';
$row = 0;
$conditions = null;
$arrayWhere = null;
$resuDefat = 0;
$dados = null;
$idg = (int) Request::Do_POST('idg', $resuDefat);
$idu = (int) Request::Do_POST('idu', $resuDefat);
$idp = (int) Request::Do_POST('idp', $resuDefat);

if ($idg != null && $idg > 0):
    $arrayWhere[] = "g.id = " . $idg . "";
endif;
if ($idu != null && $idu > 0):
    $arrayWhere[] = "u.id = " . $idu . "";
endif;
if ($idp != null && $idp > 0):
    $arrayWhere[] = "p.id = " . $idp . "";
endif;

//sql home
//grupo de um 
//$sql_tb = "Select g.groupname as grupo, u.username as usuario, \"LimiteSetor\", g.id as idg, u.id as idu"
//        . " from \"Cotas_User\" as cu,groups as g, users as u where cu.pkgroup=g.id and cu.pkuser = u.id and u.id = {$idu} ;";
$sql_tb = $sqlR->sqlHomeUsersII($arrayWhere);
$conn->sql = $sql_tb;
//execlute
$result = $conn->fetchArrayAssoc();

if ($result != null):
    foreach ($result as $r):
        $dados["data"][] = array($r["idg"], $r["idu"], $r["idp"], $r["usuario"], ($r["grupo"]=='0') ? '<b>Sem Vinculação Em Grupo</b>': $r["grupo"], $r["impressora"],$r['limite'],$r['cota']);
        $row++;//linhas pesquisadas
    endforeach;
else:
    $dados["data"] = null;
endif;
$dados['info'] = ['row' => $row, 'isOK' => NULL];

//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
