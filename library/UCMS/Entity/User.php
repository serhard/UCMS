<?php

namespace UCMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users") 
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue
     */
    protected $userId;
    
    /**
     * @ORM\Column(length = 255)
     */
    protected $username;
    
    /**
     * @ORM\Column(type = "string", length=100)
     */
    protected $password;

    /**
     * @ORM\Column(type = "datetime")
     */
    protected $lastLogin;
    
    /**
     *
     * @ORM\Column(length=50, nullable=true)
     */
    protected $role;
    
    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getLastLogin() {
        return $this->lastLogin;
    }

    public function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }
}