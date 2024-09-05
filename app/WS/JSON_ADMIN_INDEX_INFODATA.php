<?php

require './config_json.php';

//Classes de utilização e Config
$conn = new Conexao();

//variavel Class
$sqlR = new SqlRules();

//variavel 
$sql_tb = '';
$row = 0;
$resuDefat = 0;
$dados = null;

//sql home
$sql_tb = "SELECT sum(uc.pagecounter) as consumido, sum(uc.softlimit) as limite, sum(uc.softlimit) - sum(uc.pagecounter) as disponivel FROM userpquota as uc;";

$conn->sql = $sql_tb;
//execlute 
$result = $conn->fetchArrayAssoc();
if ($result != null):
    foreach ($result as $r):
        $dados["infodata"] = array("limite" => $r["limite"], "consumido" =>$r["consumido"], "disponivel" => $r["disponivel"]);
    endforeach;
else:
    $dados["infodata"] = null;
endif;

//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
