<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="id_customer", columns={"id_customer"}), @ORM\Index(name="id_address_delivery", columns={"id_address_delivery"}), @ORM\Index(name="current_state", columns={"current_state"})})
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_order", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrder;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reference", type="string", length=9, nullable=true, options={"default"="NULL"})
     */
    private $reference = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="total_paid", type="decimal", precision=20, scale=6, nullable=false, options={"default"="0.000000"})
     */
    private $totalPaid = '0.000000';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_add", type="datetime", nullable=false)
     */
    private $dateAdd;

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
     * @var \Address
     *
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_address_delivery", referencedColumnName="id_address")
     * })
     */
    private $idAddressDelivery;

    /**
     * @var \OrderStateLang
     *
     * @ORM\ManyToOne(targetEntity="OrderStateLang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="current_state", referencedColumnName="id_order_state")
     * })
     */
    private $currentState;

    /**
     * @return int
     */
    public function getIdOrder(): int
    {
        return $this->idOrder;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getTotalPaid(): string
    {
        return $this->totalPaid;
    }

    /**
     * @return DateTime
     */
    public function getDateAdd(): DateTime
    {
        return $this->dateAdd;
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
    public function getIdAddressDelivery(): mixed
    {
        return $this->idAddressDelivery;
    }

    /**
     * @return mixed
     */
    public function getCurrentState(): mixed
    {
        return $this->currentState;
    }

    /**
     * @param OrderStateLang $currentState
     */
    public function setCurrentState(OrderStateLang $currentState): void
    {
        $this->currentState = $currentState;
    }

    /**
     * @param int $idOrder
     */
    public function setIdOrder(int $idOrder): void
    {
        $this->idOrder = $idOrder;
    }

    /**
     * @param string|null $reference
     */
    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @param string $totalPaid
     */
    public function setTotalPaid(string $totalPaid): void
    {
        $this->totalPaid = $totalPaid;
    }

    /**
     * @param DateTime $dateAdd
     */
    public function setDateAdd(DateTime $dateAdd): void
    {
        $this->dateAdd = $dateAdd;
    }

    /**
     * @param Customer $idCustomer
     */
    public function setIdCustomer(Customer $idCustomer): void
    {
        $this->idCustomer = $idCustomer;
    }

    /**
     * @param Address $idAddressDelivery
     */
    public function setIdAddressDelivery(Address $idAddressDelivery): void
    {
        $this->idAddressDelivery = $idAddressDelivery;
    }


}
