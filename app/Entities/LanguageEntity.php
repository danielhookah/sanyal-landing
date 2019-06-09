<?php

namespace App\Entities;

use App\Entities\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationRepository")
 * @ORM\Table(name="`language`")
 */
class LanguageEntity extends Entity
{

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=5)
     * @var string
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="TranslationEntity", mappedBy="language")
     */
    private $translations;

    /**
     * @ORM\Column(name="`is_main`", type="boolean", nullable=true, options={"default"=false})
     * @var boolean
     */
    private $isMain;

    /**
     * Language constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function getIsMain()
    {
        return $this->isMain;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;
    }

}
