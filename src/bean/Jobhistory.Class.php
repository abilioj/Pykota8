<?php
/**
 * Description of Jobhistory
 *
 * @author abilio.jose
 */
class Jobhistory {
     
    private $id;
    private $jobid;
    private $userid;
    private $printerid;
    private $pagecounter;
    private $jobsizebytes;
    private $jobsize;
    private $jobprice;
    private $action;
    private $filename;
    private $title;
    private $copies;
    private $options;
    private $hostname;
    private $md5sum;
    private $pages;
    private $billingcode;
    private $precomputedjobsize;
    private $precomputedjobprice;
    private $jobdate;
    
    function __construct() {        
    }

    function getId() {
        return $this->id;
    }

    function getJobid() {
        return $this->jobid;
    }

    function getUserid() {
        return $this->userid;
    }

    function getPrinterid() {
        return $this->printerid;
    }

    function getPagecounter() {
        return $this->pagecounter;
    }

    function getJobsizebytes() {
        return $this->jobsizebytes;
    }

    function getJobsize() {
        return $this->jobsize;
    }

    function getJobprice() {
        return $this->jobprice;
    }

    function getAction() {
        return $this->action;
    }

    function getFilename() {
        return $this->filename;
    }

    function getTitle() {
        return $this->title;
    }

    function getCopies() {
        return $this->copies;
    }

    function getOptions() {
        return $this->options;
    }

    function getHostname() {
        return $this->hostname;
    }

    function getMd5sum() {
        return $this->md5sum;
    }

    function getPages() {
        return $this->pages;
    }

    function getBillingcode() {
        return $this->billingcode;
    }

    function getPrecomputedjobsize() {
        return $this->precomputedjobsize;
    }

    function getPrecomputedjobprice() {
        return $this->precomputedjobprice;
    }

    function getJobdate() {
        return $this->jobdate;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setJobid($jobid) {
        $this->jobid = $jobid;
    }

    function setUserid($userid) {
        $this->userid = $userid;
    }

    function setPrinterid($printerid) {
        $this->printerid = $printerid;
    }

    function setPagecounter($pagecounter) {
        $this->pagecounter = $pagecounter;
    }

    function setJobsizebytes($jobsizebytes) {
        $this->jobsizebytes = $jobsizebytes;
    }

    function setJobsize($jobsize) {
        $this->jobsize = $jobsize;
    }

    function setJobprice($jobprice) {
        $this->jobprice = $jobprice;
    }

    function setAction($action) {
        $this->action = $action;
    }

    function setFilename($filename) {
        $this->filename = $filename;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setCopies($copies) {
        $this->copies = $copies;
    }

    function setOptions($options) {
        $this->options = $options;
    }

    function setHostname($hostname) {
        $this->hostname = $hostname;
    }

    function setMd5sum($md5sum) {
        $this->md5sum = $md5sum;
    }

    function setPages($pages) {
        $this->pages = $pages;
    }

    function setBillingcode($billingcode) {
        $this->billingcode = $billingcode;
    }

    function setPrecomputedjobsize($precomputedjobsize) {
        $this->precomputedjobsize = $precomputedjobsize;
    }

    function setPrecomputedjobprice($precomputedjobprice) {
        $this->precomputedjobprice = $precomputedjobprice;
    }

    function setJobdate($jobdate) {
        $this->jobdate = $jobdate;
    }

}
