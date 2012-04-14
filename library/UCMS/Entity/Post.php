<?php

namespace UCMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts") 
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue
     */
    protected $postId;
    
    /**
     * @ORM\Column(type="bigint")
     */
    protected $userId;
    
    /**
     * @ORM\Column(type="bigint")
     */
    protected $parentId;
    
    /**
     * @ORM\Column(type="smallint")
     */
    protected $langId;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $title;
    
    /**
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;
    
    /**
     *
     * @ORM\Column(length=255)
     */
    protected $type;
    
    /**
     *
     * @ORM\Column(type="smallint")
     */
    protected $status;
    
    /**
     *
     * @ORM\Column(type="text")
     */
    protected $path;
    
    /**
     *
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    
    /**
     *
     * @ORM\Column(type="datetime")
     */
    protected $modifiedAt;

    public function getPostId() {
        return $this->postId;
    }

    public function setPostId($postId) {
        $this->postId = $postId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getParentId() {
        return $this->parentId;
    }

    public function setParentId($parentId) {
        $this->parentId = $parentId;
    }

    public function getLangId() {
        return $this->langId;
    }

    public function setLangId($langId) {
        $this->langId = $langId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getModifiedAt() {
        return $this->modifiedAt;
    }

    public function setModifiedAt($modifiedAt) {
        $this->modifiedAt = $modifiedAt;
    }
}