<?php

/*
 * ws pra alimenta Graficos
 */
require './config_json.php';

//class de utilizacao
$conn = new Conexao();
$sqlRR = new SqlRulesRelatorios();
$daGG = new DaoGeneric();
$daoGru = new DaoGroups();
$objG = new Groups();
$dadoArray = new DadosArray();

//var
$isOk = false;
$oper = null;
$rowQDD = 0;
$indxi = 0;
$indxf = (int) Request::Do_POST('indxf', -1);
$idg = (int) Request::Do_POST('idg', 0);
$idur = (int) Request::Do_POST('idur', 0); //id responsalve
$ano = (int) Request::Do_POST('ano', 0);
$op = (int) Request::Do_POST('op', 1);
$opEstat = (int) Request::Do_POST('opEstat', 0);
$dadosJson = null;
if ($ano == 0)
    $ano = 2022;


switch ($op):
    //ok - case 0 
    case 0:
        //quantidade de copia por ano de cada impressora
        $objG->setId($idg);
        $objG = $daoGru->selecionar($objG);
        if ($idur > 0):
            $conn->sql = $sqlRR->SqlViewEstatistica_imprecao_mes_por_anoErespopnsavel($idur, $ano);
        elseif ($idg > 0):
            $conn->sql = $sqlRR->SqlViewEstatistica_imprecao_mes_por_anoEgrupo($idg, $ano);
        else:
            $conn->sql = $sqlRR->SqlViewEstatistica_imprecao_mes_por_anoErespopnsavel(0, $ano);
        endif;
        $array_dados = $conn->fetchArrayAssoc();
        $rowQDD = $conn->CountRow();
        if ($array_dados != null):
            if ($idg > 0):
                $dadosJson['nome'] = $objG->getGroupname();
                foreach ($array_dados as $row):
                    $dadosJson['grafico'] = array($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12]);
                endforeach;
            else:
                foreach ($array_dados as $row):
                    $dadosJson['grafico'][] = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12]);
                    $indxi++;
                endforeach;
            endif;
        else:
            $dadosJson['grafico'] = null;
        endif;
        break;
    case 1:
        $dadosJson['graficoLabesTitle'] = $dadoArray->ArrayMeses();
        $dadosJson['grafico'] = null;
        //quantidade de copia por ano de cada impressora
        if ($opEstat == 0):
            $conn->sql = $sqlRR->sqlEstatisticaPorImpressoraAnualAtivada($ano);
            $array_dados = $conn->executeQuery()->fetchAll(PDO::FETCH_NUM);
            $rowQDD = $conn->CountRow();
            $i = 0;
            foreach ($array_dados as $row):
                $dadosJson['grafico'][] = $row[0];
            endforeach;
            foreach ($array_dados as $row):
                $dadosJson['graficoLabesNome'][] = $row[1];
            endforeach;
        else:
            //quantidade de copia por mes de cada impressora
            $conn->sql = $sqlRR->sqlEstatisticaPorImpressoraMes($ano);
            $array_dados = $conn->executeQuery()->fetchAll(PDO::FETCH_NUM);
            $rowQDD = $conn->CountRow();
            foreach ($array_dados as $row):
                $dadosJson['grafico'][] = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11]);
            endforeach;
            foreach ($array_dados as $row):
                $dadosJson['graficoLabesNome'][] = $row[12];
            endforeach;
        endif;
        break;
    case 2:
        $conn->sql = $sqlRR->SqlViewREFRESH('estatistica_imprecao_mes_por_ano_m');
        $isOk = $conn->updateQuery();
        $dadosJson['grafico'] = null;
        break;
    default :
        $dadosJson['grafico'] = null;
        break;
endswitch;

$dadosJson['info'] = ['row' => $rowQDD, "isOk" => $isOk];
echo json_encode($dadosJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//echo '<pre>'.json_encode($dadosJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).'<\pre>';
