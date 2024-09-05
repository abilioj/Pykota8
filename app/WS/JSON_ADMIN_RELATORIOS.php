<?php

/*
 * ws pra alimenta a lista de
 */
ini_set('default_charset', 'UTF-8');
require './config_json.php';

//class de utilizacao
$conn = new Conexao();
$sqlRR = new SqlRulesRelatorios();
$daGG = new DaoGeneric();

//var
$idU = Request::Do_POST('idU', 0);
$dataDefaut = $data->data_atualBD();
$dataformInp1 = Request::Do_POST('dataformInpI', $dataDefaut);
$dataformInp2 = Request::Do_POST('dataformInpII', $dataDefaut);
$dadosJson = null;
$arrayHistoricoUsuario = [];

if ($idU > 0):
    $conditions = array("u.id = {$idU}","a.jobdate between '{$dataformInp1} 00:00:00' and '{$dataformInp2} 23:59:59'");
else:
    $conditions = array("a.jobdate between '{$dataformInp1} 00:00:00' and '{$dataformInp2} 23:59:59'");
endif;

//resutado da pesquisas
$arrayHistoricoUsuario = $daGG->listHistoricoUsuario($conditions);

if (is_array($arrayHistoricoUsuario)):
    foreach ($arrayHistoricoUsuario as $row):
        $dadosJson["data"][] = array($row["nome"], $row["hostname"], $row["arquivo"], $row["qtd_paginas"]);
    endforeach;
else:
    $dadosJson["data"] = null;
endif;

echo json_encode($dadosJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
