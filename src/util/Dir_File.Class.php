<?php

/*
 * class de cria e deleta diretório 
 */

/**
 * Description of Dir_File
 *
 * @author Abílio José G Ferreira
 */
class Dir_File {
    
    private $dir;

    private function ScanDir($dir) {
        $arrfiles = array();
        if (is_dir($dir)) {
            if ($handle = opendir($dir)) {
                chdir($dir);
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        $arrfiles[] = $dir . "/" . $file;
                    }
                }
                chdir("../");
            }
            closedir($handle);
        }
        return $arrfiles;
    }

    public function CriaDiretorio($dir) {
        if (!file_exists($dir)):
            return mkdir($dir);
        else:
            return TRUE;
        endif;
    }

    public function DelDiretorio($dir) {
        if (!file_exists($dir)):
            if ($dir != null):
                return rmdir($dir);
            else:
                return FALSE;
            endif;
        else:
            return FALSE;
        endif;
    }

    public function RenomeaDiretorio($dir, $newdir) {
        return rename($dir, $newdir);
    }

    public function ScanDiretorio($dir) {
        $arrfiles = array();
        if (is_dir($dir)) {
            if ($handle = opendir($dir)) {
                chdir($dir);
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (is_dir($file)) {
                            $arr = $this->ScanDir($file);
                            foreach ($arr as $value) {
                                $arrfiles[] = $dir . "/" . $value;
                            }
                        } else {
                            $arrfiles[] = $dir . "/" . $file;
                        }
                    }
                }
                chdir("../");
            }
            closedir($handle);
        }
        return $arrfiles;
    }

    public function DelFile($paramDir,$paramFil) {
        $dir = ($paramDir == null || $paramDir =="") ? __DIR__ : $paramDir;
        $fil = ($paramFil == null || $paramFil =="") ? '*.log' : $paramFil;
        array_map('unlink', glob($dir . "/" . $fil));
    }
    
}
/*
 scandir — Lista os arquivos e diretórios que estão no caminho especificado

Descrição ¶
array scandir ( string $directory [, int $sorting_order [, resource $context ]] )
Retorna um array de arquivos e diretórios dentro de directory.

Parâmetros ¶
directory
O diretório que será pesquisado.

sorting_order
Por padrão, a lista está em ordem alfabética ascendente (menor para maior). 
Se o parâmetro opcional sorting_order for usado (com o valor 1),
então a lista será ordenada de maneira descendente.

context
Para uma descrição do parâmetro context veja a seção de streams do manual.

Valor Retornado ¶
Retorna umarray com nomes de arquivos se tiver sucesso, 
ou FALSE em caso de erro. Se directory não for um diretório,
então FALSE é retornado e um erro de nível E_WARNING é gerado.
 */