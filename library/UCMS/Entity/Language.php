<?php

namespace UCMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="languages") 
 */
class Language
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint")
     * @ORM\GeneratedValue
     */
    protected $langId;
    
    /**
     * @ORM\Column(length=255)
     */
    protected $language;
    
    public function getLangId() {
        return $this->langId;
    }

    public function setLangId($langId) {
        $this->langId = $langId;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function setLanguage($language) {
        $this->language = $language;
    }
}