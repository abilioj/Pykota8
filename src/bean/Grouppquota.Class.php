<?php
/**
 * Description of Grouppquota
 *
 * @author abilio.jose
 */
class Grouppquota {

    public function __construct(
        private int $id,
        private int $groupid,
        private int $printerid,
        private int $softlimit,
        private int $hardlimit,
        private ?string $datelimit = null,
    ) {}

    public function getId(): int {
        return $this->id;
    }

    public function getGroupid(): int {
        return $this->groupid;
    }

    public function getPrinterid(): int {
        return $this->printerid;
    }

    public function getSoftlimit(): int {
        return $this->softlimit;
    }

    public function getHardlimit(): int {
        return $this->hardlimit;
    }

    public function getDatelimit(): ?string {
        return $this->datelimit;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setGroupid(int $groupid): void {
        $this->groupid = $groupid;
    }

    public function setPrinterid(int $printerid): void {
        $this->printerid = $printerid;
    }

    public function setSoftlimit(int $softlimit): void {
        $this->softlimit = $softlimit;
    }

    public function setHardlimit(int $hardlimit): void {
        $this->hardlimit = $hardlimit;
    }

    public function setDatelimit(?string $datelimit): void {
        $this->datelimit = $datelimit;
    }

}
