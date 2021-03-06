<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Offer
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="offer")
     */
    private $authorId;


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Offer image is required", groups={"add"})
     * @Assert\Image(groups={"add"})
     */
    private $image;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status = true;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=255)
     */
    private $zipcode;

    /**
     * @var OfferSubCategory
     *
     * @ORM\ManyToOne(targetEntity="OfferSubCategory", inversedBy="idOffer")
     */
    private $idSubCategory;

    /**
     * @var int
     *
     * @ORM\Column(name="number_views", type="integer", nullable=true)
     */
    private $numberViews = 0;

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
     * @var Transaction
     *
     * @ORM\OneToOne(targetEntity="Transaction", mappedBy="offer")
     */
    private $transaction;

    /**
     * @var Message
     *
     * @ORM\OneToMany(targetEntity="Message", mappedBy="subject")
     */
    private $message;

    /**
     * @var UserOfferBookmark
     *
     * @ORM\OneToMany(targetEntity="UserOfferBookmark", mappedBy="idOffer")
     */
    private $bookmark;

    /**
     * @var Message
     *
     * @ORM\OneToMany(targetEntity="Message", mappedBy="relateOffer")
     */
    private $relateMessages;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->relateMessages = new ArrayCollection();
        $this->bookmark = new ArrayCollection();
    }

    /**
     *  @ORM\PrePersist
     */
    public function setCreatedDateValue(){
        $this->createdDate = new \DateTime();
    }
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedDateValue(){
        $this->updatedDate = new \DateTime();
    }


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
     * Set title
     *
     * @param string $title
     *
     * @return Offer
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Offer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Offer
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Offer
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
     * Set status
     *
     * @param boolean $status
     *
     * @return Offer
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return Offer
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set idSubCategory
     *
     * @param integer $idSubCategory
     *
     * @return Offer
     */
    public function setIdSubCategory($idSubCategory)
    {
        $this->idSubCategory = $idSubCategory;

        return $this;
    }

    /**
     * Get idSubCategory
     *
     * @return int
     */
    public function getIdSubCategory()
    {
        return $this->idSubCategory;
    }

    /**
     * Set numberViews
     *
     * @param integer $numberViews
     *
     * @return Offer
     */
    public function setNumberViews($numberViews)
    {
        $this->numberViews = $numberViews;

        return $this;
    }

    /**
     * Get numberViews
     *
     * @return int
     */
    public function getNumberViews()
    {
        return $this->numberViews;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Offer
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
     * @return Offer
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
     * Set transaction
     *
     * @param \AppBundle\Entity\Transaction $transaction
     *
     * @return Offer
     */
    public function setTransaction(\AppBundle\Entity\Transaction $transaction = null)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \AppBundle\Entity\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }


    /**
     * Set authorId
     *
     * @param \AppBundle\Entity\User $authorId
     *
     * @return Offer
     */
    public function setAuthorId(\AppBundle\Entity\User $authorId = null)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Add message
     *
     * @param \AppBundle\Entity\Message $message
     *
     * @return Offer
     */
    public function addMessage(\AppBundle\Entity\Message $message)
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \AppBundle\Entity\Message $message
     */
    public function removeMessage(\AppBundle\Entity\Message $message)
    {
        $this->message->removeElement($message);
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Add bookmark
     *
     * @param \AppBundle\Entity\UserOfferBookmark $bookmark
     *
     * @return Offer
     */
    public function addBookmark(\AppBundle\Entity\UserOfferBookmark $bookmark)
    {
        $this->bookmark[] = $bookmark;

        return $this;
    }

    /**
     * Remove bookmark
     *
     * @param \AppBundle\Entity\UserOfferBookmark $bookmark
     */
    public function removeBookmark(\AppBundle\Entity\UserOfferBookmark $bookmark)
    {
        $this->bookmark->removeElement($bookmark);
    }

    /**
     * Get bookmark
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookmark()
    {
        return $this->bookmark;
    }

    /**
     * Add relateMessage
     *
     * @param \AppBundle\Entity\Message $relateMessage
     *
     * @return Offer
     */
    public function addRelateMessage(\AppBundle\Entity\Message $relateMessage)
    {
        $this->relateMessages[] = $relateMessage;

        return $this;
    }

    /**
     * Remove relateMessage
     *
     * @param \AppBundle\Entity\Message $relateMessage
     */
    public function removeRelateMessage(\AppBundle\Entity\Message $relateMessage)
    {
        $this->relateMessages->removeElement($relateMessage);
    }

    /**
     * Get relateMessages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelateMessages()
    {
        return $this->relateMessages;
    }
}
