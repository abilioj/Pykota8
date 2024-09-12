<?php

/**
 * Description of GroupsMembers
 *
 * @author abilio.jose
 */
class GroupsMembers {

    public function __construct(
        public int $groupid,
        public int $userid,
    ) {}

    public function setGroupid(int $groupid): void {
        $this->groupid = $groupid;
    }

    public function setUserid(int $userid): void {
        $this->userid = $userid;
    }

    public function getGroupid(): int {
        return $this->groupid;
    }

    public function getUserid(): int {
        return $this->userid;
    }

}
