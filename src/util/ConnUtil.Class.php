<?php

/**
 * Description of ConnUtil
 *
 * @author abilio.jose
 */
class ConnUtil{
   
    public function countRowSql(string $paramSql) : int {
        $conn = new Conexao();
        $conn->sql = $paramSql;
        $conn->executeQuery();
        return $conn->getNumrows();
    }
    
}
