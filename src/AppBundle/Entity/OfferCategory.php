<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferCategory
 *
 * @ORM\Table(name="offer_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferCategoryRepository")
 */
class OfferCategory
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
     * @var OfferSubCategory
     *
     * @ORM\OneToMany(targetEntity="OfferSubCategory", mappedBy="idCategory")
     */
    private $idSubCategory;


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
     * @return OfferCategory
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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return OfferCategory
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
     * @return OfferCategory
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
        $this->idSubCategory = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idSubCategory
     *
     * @param \AppBundle\Entity\OfferSubCategory $idSubCategory
     *
     * @return OfferCategory
     */
    public function addIdSubCategory(\AppBundle\Entity\OfferSubCategory $idSubCategory)
    {
        $this->idSubCategory[] = $idSubCategory;

        return $this;
    }

    /**
     * Remove idSubCategory
     *
     * @param \AppBundle\Entity\OfferSubCategory $idSubCategory
     */
    public function removeIdSubCategory(\AppBundle\Entity\OfferSubCategory $idSubCategory)
    {
        $this->idSubCategory->removeElement($idSubCategory);
    }

    /**
     * Get idSubCategory
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdSubCategory()
    {
        return $this->idSubCategory;
    }
}
