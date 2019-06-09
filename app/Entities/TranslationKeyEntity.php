<?php

namespace App\Entities;

use App\Entities\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationRepository")
 * @ORM\Table(name="`translation_key`")
 */
class TranslationKeyEntity extends Entity
{

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="TranslationEntity", mappedBy="key")
     */
    private $translations;

    public function __construct()
    {
        parent::__construct();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

}
