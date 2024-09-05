<?php

ini_set('default_charset', 'UTF-8');
require './config_json.php';

//variavel Class
$conn = new Conexao();
$dao = new DaoIPPrinter();

//variavel 
$sql_tb = '';
$i = 1;
$Dados = null;
$DIR ="FOR - Formulários/";
$path = "/opt/arquivos/qualidade/" . $DIR;
$diretorio = dir($path);
while ($arquivo = $diretorio->read()) {
    if ($arquivo != "." && $arquivo != ".."):
        $dados["data"][] = array($i, "<a href='Q:/FOR - Formulários/".$arquivo."'>".$arquivo."</a>");
        $i++;
    endif;
}
$diretorio->close();

echo json_encode($dados, JSON_PRETTY_PRINT);
//echo '<pre>' . json_encode($last_line, JSON_PRETTY_PRINT) . '</pre>';
//echo json_encode($last_line, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
