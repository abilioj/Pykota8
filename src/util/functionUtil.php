<?php

/**
 * Description of functionUtil
 *
 * @author abilio.jose
 */
class functionUtil {    
    
function updateQuery2Array(array $sqlArray): bool {
    $isok = false;
    $connConf = new ConfigBDClass();
    $conn = pg_connect("host={$connConf->getServidor()} port={$connConf->getPorta()} dbname={$connConf->getBancoDeDados()} user={$connConf->getUsuario()} password={$connConf->getSenha()}");
    pg_query($conn, "begin");
    $result1 = pg_query($conn, $sqlArray[0]);
    $result2 = pg_query($conn, $sqlArray[1]);
    if ($result1 && $result2) {
        $row1 = pg_affected_rows($result1);
        $row2 = pg_affected_rows($result2);
        $isok = true;
        pg_query($conn, "commit");
    } else {
        pg_query($conn, "rollback");
    }
// Fecha a conexão com o banco
    pg_close($conn);
    return $isok;
}

}
