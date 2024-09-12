<?php
/**
 * Description of Groups
 *
 * @author abilio.jose
 */
class Groups {
    
    public function __construct(
        private int $id = 0,
        private string $groupname =  '',
        private string $description = '',
        private string $limitby = '',
    ) {}

    public function getId(): int {
        return $this->id;
    }

    public function getGroupname(): string {
        return $this->groupname;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getLimitby(): string {
        return $this->limitby;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setGroupname(string $groupname): void {
        $this->groupname = $groupname;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setLimitby(string $limitby): void {
        $this->limitby = $limitby;
    }

}
