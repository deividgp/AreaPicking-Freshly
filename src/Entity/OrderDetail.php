<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderDetail
 *
 * @ORM\Table(name="order_detail", indexes={@ORM\Index(name="id_order", columns={"id_order"})})
 * @ORM\Entity
 */
class OrderDetail
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_order_detail", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrderDetail;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=255, nullable=false)
     */
    private $productName;

    /**
     * @var int
     *
     * @ORM\Column(name="product_quantity", type="integer", nullable=false)
     */
    private $productQuantity;

    /**
     * @var Orders
     *
     * @ORM\ManyToOne(targetEntity="Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_order", referencedColumnName="id_order")
     * })
     */
    private $idOrder;

    /**
     * @return int
     */
    public function getIdOrderDetail(): int
    {
        return $this->idOrderDetail;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return int
     */
    public function getProductQuantity(): int
    {
        return $this->productQuantity;
    }

    /**
     * @return Orders
     */
    public function getIdOrder(): Orders
    {
        return $this->idOrder;
    }


}
