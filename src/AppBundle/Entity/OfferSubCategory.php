<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferSubCategory
 *
 * @ORM\Table(name="offer_sub_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferSubCategoryRepository")
 */
class OfferSubCategory
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var OfferCategory
     *
     * @ORM\ManyToOne(targetEntity="OfferCategory", inversedBy="idSubCategory")
     */
    private $idCategory;

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
     * @var Offer
     *
     * @ORM\OneToMany(targetEntity="Offer", mappedBy="idSubCategory")
     */
    private $idOffer;


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
     * Set name
     *
     * @param string $name
     *
     * @return OfferSubCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set idCategory
     *
     * @param integer $idCategory
     *
     * @return OfferSubCategory
     */
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;

        return $this;
    }

    /**
     * Get idCategory
     *
     * @return int
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return OfferSubCategory
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
     * @return OfferSubCategory
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idOffer = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idOffer
     *
     * @param \AppBundle\Entity\Offer $idOffer
     *
     * @return OfferSubCategory
     */
    public function addIdOffer(\AppBundle\Entity\Offer $idOffer)
    {
        $this->idOffer[] = $idOffer;

        return $this;
    }

    /**
     * Remove idOffer
     *
     * @param \AppBundle\Entity\Offer $idOffer
     */
    public function removeIdOffer(\AppBundle\Entity\Offer $idOffer)
    {
        $this->idOffer->removeElement($idOffer);
    }

    /**
     * Get idOffer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdOffer()
    {
        return $this->idOffer;
    }
}
