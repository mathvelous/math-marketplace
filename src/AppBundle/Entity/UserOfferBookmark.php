<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserOfferBookmark
 *
 * @ORM\Table(name="user_offer_bookmark")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserOfferBookmarkRepository")
 */
class UserOfferBookmark
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="id")
     */
    private $idUser;

    /**
     * @var Offer
     *
     * @ORM\ManyToOne(targetEntity="Offer", inversedBy="id")
     */
    private $idOffer;

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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return UserOfferBookmark
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idOffer
     *
     * @param integer $idOffer
     *
     * @return UserOfferBookmark
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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return UserOfferBookmark
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
     * @return UserOfferBookmark
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
