<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sellerTransaction")
     */
    private $idSeller;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="buyerTransaction")
     */
    private $idBuyer;

    /**
     * @var int
     *
     * @ORM\Column(name="id_offer", type="integer")
     */
    private $idOffer;

    /**
     * @var float
     *
     * @ORM\Column(name="fee", type="float")
     */
    private $fee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_date", type="datetime")
     */
    private $updatedDate;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Transaction
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Transaction
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set idSeller
     *
     * @param integer $idSeller
     *
     * @return Transaction
     */
    public function setIdSeller($idSeller)
    {
        $this->idSeller = $idSeller;

        return $this;
    }

    /**
     * Get idSeller
     *
     * @return int
     */
    public function getIdSeller()
    {
        return $this->idSeller;
    }

    /**
     * Set idBuyer
     *
     * @param integer $idBuyer
     *
     * @return Transaction
     */
    public function setIdBuyer($idBuyer)
    {
        $this->idBuyer = $idBuyer;

        return $this;
    }

    /**
     * Get idBuyer
     *
     * @return int
     */
    public function getIdBuyer()
    {
        return $this->idBuyer;
    }

    /**
     * Set idOffer
     *
     * @param integer $idOffer
     *
     * @return Transaction
     */
    public function setIdOffer($idOffer)
    {
        $this->idOffer = $idOffer;

        return $this;
    }

    /**
     * Get idOffer
     *
     * @return int
     */
    public function getIdOffer()
    {
        return $this->idOffer;
    }

    /**
     * Set fee
     *
     * @param float $fee
     *
     * @return Transaction
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * Get fee
     *
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Transaction
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     *
     * @return Transaction
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }
}

