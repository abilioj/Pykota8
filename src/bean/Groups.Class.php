<?php
/**
 * Description of Groups
 *
 * @author abilio.jose
 */
class Groups {
    
    private $id;
    private $groupname;
    private $description;
    private $limitby;
    
    function __construct() {        
    }

    function getId() : int {
        return (int)$this->id;
    }

    function getGroupname() : string {
        return (string)$this->groupname;
    }

    function getDescription() : string {
        return (string) $this->description;
    }

    function getLimitby() : string{
        return (string)$this->limitby;
    }

    function setId(int $id) {
        $this->id = (int) $id;
    }

    function setGroupname(string $groupname) {
        $this->groupname = (string) $groupname;
    }

    function setDescription(string $description) {
        $this->description = (string) $description;
    }

    function setLimitby(string $limitby) {
        $this->limitby = (string) $limitby;
    }

}
