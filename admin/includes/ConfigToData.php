<?php
//configurando a Data dos campos verificando por Navegador
$InfoSettings->GETNavegador();
$PHTML->data_field_type($InfoSettings->getBrowserID());

$tpl->block("" . $PHTML->getBlock() . "");
$tpl->clear("" . $PHTML->getClear() . "");