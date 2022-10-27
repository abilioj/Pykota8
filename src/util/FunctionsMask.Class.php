<?php

/**
 * Description of Mask
 *
 * @author AJGF
 */
class FunctionsMask {

    private $textString;
    private $maskared;

    function __construct() {
        
    }

    public function FuncMask($val, $mask) {
        $this->maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $this->maskared .= $val[$k++];
            }
            else {
                if (isset($mask[$i]))
                    $this->maskared .= $mask[$i];
            }
        }
        return $this->maskared;
    }

    public function OutputFoneTel($param) {
        $this->textString = $this->FuncMask($param, '####-####');
        return (string) $this->textString;
    }

    public function OutputFoneCel($param) {
        $this->textString = $this->FuncMask($param, '#####-####');
        return (string) $this->textString;
    }

    public function OutputCpf($param) {
        $this->textString = $this->FuncMask($param, '###.###.###-##');
        return (string) $this->textString;
    }

    public function OutputCnpf($param) {
        $this->textString = $this->FuncMask($param, '##.###.###/####-##');
        return (string) $this->textString;
    }
    
    public function OutputCep($param) {
        $this->textString = $this->FuncMask($param, '#####-###');
        return (string) $this->textString;
    }

    public function OutputDat($param) {
        $this->textString = $this->FuncMask($param, '##/##/####');
        return (string) $this->textString;
    }

//    public function OutputCoin($param) {
//        $this->textString = $this->FuncMask($param, '');//"R$:"
//        return (string) $this->textString;
//    }

    public function getTextString(): string {
        return (string) $this->textString;
    }

}
