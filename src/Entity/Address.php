<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address", indexes={@ORM\Index(name="id_customer", columns={"id_customer"}), @ORM\Index(name="id_country", columns={"id_country"})})
 * @ORM\Entity
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_address", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="address1", type="string", length=128, nullable=false)
     */
    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=128, nullable=false)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=64, nullable=false)
     */
    private $city;

    /**
     * @var \Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_customer", referencedColumnName="id_customer")
     * })
     */
    private $idCustomer;

    /**
     * @var \CountryLang
     *
     * @ORM\ManyToOne(targetEntity="CountryLang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_country", referencedColumnName="id_country")
     * })
     */
    private $idCountry;

    /**
     * @return int
     */
    public function getIdAddress(): int
    {
        return $this->idAddress;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getIdCustomer(): mixed
    {
        return $this->idCustomer;
    }

    /**
     * @return mixed
     */
    public function getIdCountry(): mixed
    {
        return $this->idCountry;
    }

    public function __toString(): string
    {
        return $this->address1." ".$this->address2." ".$this->city." ".$this->idCountry->getName().PHP_EOL;
    }
}
