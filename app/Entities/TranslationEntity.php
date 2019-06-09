<?php

namespace App\Entities;

use App\Entities\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationRepository")
 * @ORM\Table(name="`translation`")
 */
class TranslationEntity extends Entity
{

    /**
     * @ORM\ManyToOne(targetEntity="LanguageEntity", cascade={"persist"})
     * @ORM\JoinColumn(name="language", referencedColumnName="id", onDelete="CASCADE")
     * */
    private $lang;

    /**
     * @ORM\ManyToOne(targetEntity="TranslationKeyEntity")
     * @ORM\JoinColumn(name="translation_key", referencedColumnName="id")
     * */
    private $key;

    /**
     * @ORM\Column(name="`translation_value`", type="text", nullable=true)
     */
    private $value;

    public function __construct()
    {
        parent::__construct();
    }

    public function getLanguage()
    {
        return $this->lang;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setLanguage($lang)
    {
        $this->lang = $lang;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

}
