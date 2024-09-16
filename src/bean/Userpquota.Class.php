<?php
/**
 * Description of Userpquota
 *
 * @author abilio.jose
 */
class Userpquota {
    
    public function __construct(
        private int $id = 0,
        private int $userid = 0,
        private int $printerid = 0,
        private int $lifepagecounter = 0,
        private int $pagecounter = 0,
        private int $softlimit = 0,
        private int $hardlimit = 0,
        private int $maxjobsize = 0,
        private int $warncount = 0,
        private string $datelimit = ''
    ) {
        $data = new Data();
        $this->datelimit = empty($this->datelimit) ? $data->dataEhora_atual_en() : $this->datelimit;
    }

    
    public function getId(): int {
        return $this->id;
    }

    public function getUserid(): int {
        return $this->userid;
    }

    public function getPrinterid(): int {
        return $this->printerid;
    }

    public function getLifepagecounter(): int {
        return $this->lifepagecounter;
    }

    public function getPagecounter(): int {
        return $this->pagecounter;
    }

    public function getSoftlimit(): int {
        return $this->softlimit;
    }

    public function getHardlimit(): int {
        return $this->hardlimit;
    }

    public function getDatelimit(): string {
        return $this->datelimit;
    }

    public function getMaxjobsize(): int {
        return $this->maxjobsize;
    }

    public function getWarncount(): int {
        return $this->warncount;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUserid(int $userid): void {
        $this->userid = $userid;
    }

    public function setPrinterid(int $printerid): void {
        $this->printerid = $printerid;
    }

    public function setLifepagecounter(int $lifepagecounter): void {
        $this->lifepagecounter = $lifepagecounter;
    }

    public function setPagecounter(int $pagecounter): void {
        $this->pagecounter = $pagecounter;
    }

    public function setSoftlimit(int $softlimit): void {
        $this->softlimit = $softlimit;
    }

    public function setHardlimit(int $hardlimit): void {
        $this->hardlimit = $hardlimit;
    }

    public function setDatelimit(string $datelimit): void {
        $this->datelimit = $datelimit;
    }

    public function setMaxjobsize(int $maxjobsize): void {
        $this->maxjobsize = $maxjobsize;
    }

    public function setWarncount(int $warncount): void {
        $this->warncount = $warncount;
    }

}
