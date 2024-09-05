<?php
/**
 * Description of Coefficients 
 *
 * @author abilio.jose
 */
class Coefficients {
    
    private $id;
    private $printerid;
    private $label;
    private $coefficient;
    
    function __construct() {        
    }

    function getId() {
        return $this->id;
    }

    function getPrinterid() {
        return $this->printerid;
    }

    function getLabel() {
        return $this->label;
    }

    function getCoefficient() {
        return $this->coefficient;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPrinterid($printerid) {
        $this->printerid = $printerid;
    }

    function setLabel($label) {
        $this->label = $label;
    }

    function setCoefficient($coefficient) {
        $this->coefficient = $coefficient;
    }

}
