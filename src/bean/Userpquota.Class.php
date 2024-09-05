<?php
/**
 * Description of Userpquota
 *
 * @author abilio.jose
 */
class Userpquota {
    
    private $id;
    private $userid;
    private $printerid;
    private $lifepagecounter;
    private $pagecounter;
    private $softlimit;
    private $hardlimit;
    private $datelimit;
    private $maxjobsize;
    private $warncount;
    
    function __construct(int $id) {
        $data = new Data();
        $this->id = $id;
        $this->lifepagecounter = (int) 0;
        $this->pagecounter = (int) 0;
        $this->softlimit = (int) 0;
        $this->hardlimit = (int) 0;
        $this->maxjobsize = (int) 0;
        $this->warncount = (int) 0;
        $this->datelimit = $data->dataEhora_atual_en();
    }
    
    function getId() {
        return $this->id;
    }

    function getUserid() {
        return $this->userid;
    }

    function getPrinterid() {
        return $this->printerid;
    }

    function getLifepagecounter() {
        return $this->lifepagecounter;
    }

    function getPagecounter() {
        return $this->pagecounter;
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

    function getMaxjobsize() {
        return $this->maxjobsize;
    }

    function getWarncount() {
        return $this->warncount;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserid($userid) {
        $this->userid = $userid;
    }

    function setPrinterid($printerid) {
        $this->printerid = $printerid;
    }

    function setLifepagecounter($lifepagecounter) {
        $this->lifepagecounter = $lifepagecounter;
    }

    function setPagecounter($pagecounter) {
        $this->pagecounter = $pagecounter;
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

    function setMaxjobsize($maxjobsize) {
        $this->maxjobsize = $maxjobsize;
    }

    function setWarncount($warncount) {
        $this->warncount = $warncount;
    }

}
