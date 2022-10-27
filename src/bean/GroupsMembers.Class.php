<?php

/**
 * Description of GroupsMembers
 *
 * @author abilio.jose
 */
class GroupsMembers {

    private $groupid;
    private $userid;

    function __construct(int $groupid, int $userid) {
        $this->groupid = (int) $groupid;
        $this->userid = (int) $userid;
    }

    function setGroupid(int $groupid) {
        $this->groupid = (int) $groupid;
    }

    function setUserid(int $userid) {
        $this->userid = (int) $userid;
    }

    function getGroupid() : int {
        return (int) $this->groupid;
    }

    function getUserid() : int {
        return (int) $this->userid;
    }

}
