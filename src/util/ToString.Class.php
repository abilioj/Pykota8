<?php

/**
 * Description of ToString
 *
 * @author Abílio José G Ferreira
 */
class ToString {

    //Validar a String trirando e revendo caracter especial-
    public static function ValidarStringCampoI(string $string) : string {
        return trim($string);
    }

    //Validar a String trirando e revendo caracter especial-
    public static function ValidarStringCampoII(string $string) : string {
        return htmlspecialchars(trim($string), ENT_QUOTES);
    }

    //coloca a String toda minuscula
    public static function StringPraMinusculo(string $string) : string {
        return htmlspecialchars(trim(strtolower($string)), ENT_QUOTES);
    }

    //coloca a String toda maiúsculas
    public static function StringPraMaiusculas(string $string) : string {
        return htmlspecialchars(trim(strtoupper($string)), ENT_QUOTES);
    }

    //coloca a String toda 1ª Letra e maiúsculas
    public static function String1LMaiusculas(string $string) : string {
        return htmlspecialchars(trim(ucfirst($string)), ENT_QUOTES);
    }

    //criptografa em MD5
    public static function criptografaMD5(string $string) : string {
        return htmlspecialchars(MD5(trim($string)), ENT_QUOTES);
    }

    //criptografa em BASE64
    public static function criptografaBASE64(string $string):string {
        return htmlspecialchars(base64_encode(trim($string)), ENT_QUOTES);
    }

    //descriptografa em BASE64
    public static function descriptografaBASE64(string $string):string {
        return htmlspecialchars(base64_decode(trim($string)), ENT_QUOTES);
    }

    //Gerar noma Senhas
    public static function makeRandomPassword(): string {
        $salt = "abchefghjkmnpqrstuvwxyz0123456789";
        srand((double) microtime() * 1000000);
        $i = 0;
        $pass = "";
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($salt, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }

    //Gerar nova Cod
    //funcao rand —> Gera um inteiro aleatório
    public static function makeRandomCod(): string {
        $pass = "";
        $cartString = "abchefghjkmnpqrstuvwxyz";
        $cartNamber = "0123456789";
        $salt = $cartNamber;
        srand((double) microtime() * 1000000);
        $i = 0;
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($salt, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }

    //Encontra a posição de String
    //$haystack String a ser verificada
    // $needle string para de parte a conter
    public static function VerifecaParteDeString(string $haystack, string $needle): bool {
        if ($needle != null):
            $pos = strripos($haystack, $needle);
            if ($pos === false)://"Sinto muito, nós não encontramos ($needle) em ($haystack)";
                return false;
            else://"Nós encontramos a última ($needle) em ($haystack) na posição ($pos)";
                return true;
            endif;
        else:
            return true;
        endif;
    }

    public static function RetornaParteString(string $text, string $ini, string $fim): string {
        return htmlspecialchars(trim(substr($text, $ini, $fim)), ENT_QUOTES);
    }

    public static function TrocarCaracte(string $Cct,string $CctACerTrocado, string $string): array|string {
        return str_replace($Cct, $CctACerTrocado, $string);
    }

    public static function setToAspaSAspaD(string $string): string {
        return str_replace("'", '"', $string);
    }

}
