<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CountryLang
 *
 * @ORM\Table(name="country_lang")
 * @ORM\Entity
 */
class CountryLang
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_country", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @return int
     */
    public function getIdCountry(): int
    {
        return $this->idCountry;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}
