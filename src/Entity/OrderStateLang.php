<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderStateLang
 *
 * @ORM\Table(name="order_state_lang")
 * @ORM\Entity
 */
class OrderStateLang
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_order_state", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrderState;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @return int
     */
    public function getIdOrderState(): int
    {
        return $this->idOrderState;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name.PHP_EOL;
    }
}
