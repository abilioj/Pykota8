<?php
/**
 * Description of Jobhistory
 *
 * @author abilio.jose
 */
class Jobhistory {
     
    public function __construct(
        private int $id = 0,
        private int $jobid = 0,
        private int $userid = 0,
        private int $printerid = 0,
        private int $pagecounter = 0,
        private int $jobsizebytes = 0,
        private float $jobsize = 0.0,
        private float $jobprice = 0.0,
        private string $action = '',
        private string $filename = '',
        private string $title = '',
        private int $copies = 0,
        private string $options = '',
        private string $hostname = '',
        private string $md5sum = '',
        private int $pages = 0,
        private string $billingcode = '',
        private ?int $precomputedjobsize = null,
        private ?float $precomputedjobprice = null,
        private ?string $jobdate = null,
    ) {
    }

    public function getId(): int {
        return $this->id;
    }

    public function getJobid(): int {
        return $this->jobid;
    }

    public function getUserid(): int {
        return $this->userid;
    }

    public function getPrinterid(): int {
        return $this->printerid;
    }

    public function getPagecounter(): int {
        return $this->pagecounter;
    }

    public function getJobsizebytes(): int {
        return $this->jobsizebytes;
    }

    public function getJobsize(): float {
        return $this->jobsize;
    }

    public function getJobprice(): float {
        return $this->jobprice;
    }

    public function getAction(): string {
        return $this->action;
    }

    public function getFilename(): string {
        return $this->filename;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getCopies(): int {
        return $this->copies;
    }

    public function getOptions(): string {
        return $this->options;
    }

    public function getHostname(): string {
        return $this->hostname;
    }

    public function getMd5sum(): string {
        return $this->md5sum;
    }

    public function getPages(): int {
        return $this->pages;
    }

    public function getBillingcode(): string {
        return $this->billingcode;
    }

    public function getPrecomputedjobsize(): ?int {
        return $this->precomputedjobsize;
    }

    public function getPrecomputedjobprice(): ?float {
        return $this->precomputedjobprice;
    }

    public function getJobdate(): ?string {
        return $this->jobdate;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setJobid(int $jobid): void {
        $this->jobid = $jobid;
    }

    public function setUserid(int $userid): void {
        $this->userid = $userid;
    }

    public function setPrinterid(int $printerid): void {
        $this->printerid = $printerid;
    }

    public function setPagecounter(int $pagecounter): void {
        $this->pagecounter = $pagecounter;
    }

    public function setJobsizebytes(int $jobsizebytes): void {
        $this->jobsizebytes = $jobsizebytes;
    }

    public function setJobsize(float $jobsize): void {
        $this->jobsize = $jobsize;
    }

    public function setJobprice(float $jobprice): void {
        $this->jobprice = $jobprice;
    }

    public function setAction(string $action): void {
        $this->action = $action;
    }

    public function setFilename(string $filename): void {
        $this->filename = $filename;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setCopies(int $copies): void {
        $this->copies = $copies;
    }

    public function setOptions(string $options): void {
        $this->options = $options;
    }

    public function setHostname(string $hostname): void {
        $this->hostname = $hostname;
    }

    public function setMd5sum(string $md5sum): void {
        $this->md5sum = $md5sum;
    }

    public function setPages(int $pages): void {
        $this->pages = $pages;
    }

    public function setBillingcode(string $billingcode): void {
        $this->billingcode = $billingcode;
    }

    public function setPrecomputedjobsize(?int $precomputedjobsize): void {
        $this->precomputedjobsize = $precomputedjobsize;
    }

    public function setPrecomputedjobprice(?float $precomputedjobprice): void {
        $this->precomputedjobprice = $precomputedjobprice;
    }

    public function setJobdate(?string $jobdate): void {
        $this->jobdate = $jobdate;
    }
}
