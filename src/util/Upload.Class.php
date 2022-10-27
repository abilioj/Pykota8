<?php

/**
 * Description of Upload
 *
 * @author Abílio José G Ferreira
 */
class Upload {

    public $MSG;

    public function UploadSimple($caminhodapasta, $campoupload, $tamanhoP, $tiposPermitidos, $nomeimagem) {
        if ($tiposPermitidos == null)
            $tiposPermitidos = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');// Lista de tipos de arquivos permitidos
            $tamanhoPermitido = 1024 * $tamanhoP;// Tamanho máximo (em bytes)
        $arqName = $_FILES[$campoupload]['name'];// O nome original do arquivo no computador do usuário
        $arqType = $_FILES[$campoupload]['type'];// O tipo mime do arquivo. Um exemplo pode ser "image/gif"
        $arqSize = $_FILES[$campoupload]['size'];// O tamanho, em bytes, do arquivo
        $arqTemp = $_FILES[$campoupload]['tmp_name'];// O nome temporário do arquivo, como foi guardado no servidor
        $arqError = $_FILES[$campoupload]['error'];// O código de erro associado a este upload de arquivo
        if ($arqError == 0) {// Verifica o tipo de arquivo enviado            
            if (array_search($arqType, $tiposPermitidos) === false) {//echo 'O tipo de arquivo enviado é inválido!';
                return false;               
            } else if ($arqSize > $tamanhoPermitido) { // Verifica o tamanho do arquivo enviado
                return false;
                //echo 'O tamanho do arquivo enviado é maior que o limite!';//Não houveram erros, move o arquivo
            } else {
                // $extensao = strtolower(strrchr($arqName, "."));// Pega a extensão do arquivo enviado
                //$nome = $nomeimagem . $extensao; //. '.' // Define o novo nome do arquivo usando um UNIX TIMESTAMP
                $upload = move_uploaded_file($arqTemp, $caminhodapasta . $nomeimagem);
                if($upload):
                    return true;
                else:
                    return false;
                endif;
            }
        }
    }

    public function UploadRedireccionar($campoupload, $caminhodapasta, $nomeimagem, $Wt1, $Ht1, $Wt2, $Ht2, $qualidade) {
        if ($qualidade != null)
            $qualidade = 100;
        if (move_uploaded_file($_FILES[$campoupload]['tmp_name'], $caminhodapasta . $nomeimagem)) {
            // Utilizámos agora a "magia" da Classe para criar os tamanhos necessários
            $img = $caminhodapasta . $nomeimagem;
            $resize_tamanho1 = new resize($img);
            $resize_tamanho2 = new resize($img);
            // Definimos as medidas que cada tamanho irá ter
            $resize_tamanho1->resizeImage($Wt1, $Ht1, 'crop');
            $resize_tamanho2->resizeImage($Wt2, $Ht2, 'crop');
            // Renomeámos a imagem para que seja possivel o mesmo nome ter vários tamanhos
            $tamanho1 = "t1_" . $nomeimagem;
            $tamanho2 = "t2_" . $nomeimagem;
            // Para finalizar guardámos a im0agem. Definimos o caminho, qual o nome e a qualidade
            if ($resize_tamanho1->saveImage($caminhodapasta . $tamanho1, $qualidade) && $resize_tamanho2->saveImage($caminhodapasta . $tamanho2, $qualidade)) {
                //O próximo passo é opcional mas recomendável.
                //Apagámos a imagem original
                unlink($caminhodapasta . $nomeimagem);
                return true;
            } else {
                return false;
            }
        } else {
            // No caso de erro no upload, podem redireccionar para outra página ou criar uma notificação
            return false;
        }
    }

    public function variosUpload($caminhodapasta, $campoupload, $tamanhoP, $tiposPermitidos, $nomeimagem) {
        foreach ($_FILES[$campoupload]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES[$campoupload]["tmp_name"][$key];
                $name = $_FILES[$campoupload]["name"][$key];
                $true = move_uploaded_file($tmp_name, $caminhodapasta .$name);
            }
            if (!$true) break;
        }
        return $true;
    }

}
