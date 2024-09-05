<?php
/**
 * Description of Grouppquota
 *
 * @author abilio.jose
 */
class Grouppquota {
     
    private $id;
    private $groupid;
    private $printerid;
    private $softlimit;
    private $hardlimit;
    private $datelimit;
    
    function __construct() {        
    }

    function getId() {
        return $this->id;
    }

    function getGroupid() {
        return $this->groupid;
    }

    function getPrinterid() {
        return $this->printerid;
    }

    function getSoftlimit() {
        return $this->softlimit;
    }

    function getHardlimit() {
        return $this->hardlimit;
    }

    function getDatelimit() {
        return $this->datelimit;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setGroupid($groupid) {
        $this->groupid = $groupid;
    }

    function setPrinterid($printerid) {
        $this->printerid = $printerid;
    }

    function setSoftlimit($softlimit) {
        $this->softlimit = $softlimit;
    }

    function setHardlimit($hardlimit) {
        $this->hardlimit = $hardlimit;
    }

    function setDatelimit($datelimit) {
        $this->datelimit = $datelimit;
    }

}
