<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @UniqueEntity(fields="username", message="Username already taken")
 * @ORM\HasLifecycleCallbacks()
 */

class User implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, )
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255, nullable=true)
     */
    private $gender = null;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255, nullable=true)
     */
    private $adress = null;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city = null;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=255, nullable=true)
     */
    private $zipcode = null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createddate", type="date")
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateddate", type="datetime")
     */
    private $updatedDate;


    /**
     * @var Transaction
     *
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="seller")
     */
    private $sellerTransaction;


    /**
     * @var Transaction
     *
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="buyer")
     */
    private $buyerTransaction;


    /**
     * @var Message
     *
     * @ORM\OneToMany(targetEntity="Message", mappedBy="author")
     */
    private $authorMessage;

    /**
     * @var Message
     *
     * @ORM\OneToMany(targetEntity="Message", mappedBy="dest")
     */
    private $destMessage;

    /**
     * @var Notifications
     *
     * @ORM\OneToMany(targetEntity="Notifications", mappedBy="idUser")
     */
    private $notification;

    /**
     * @var Offer
     *
     * @ORM\OneToMany(targetEntity="Offer", mappedBy="authorId")
     */
    private $offer;

    /**
     * @var UserOfferBookmark
     *
     * @ORM\OneToMany(targetEntity="UserOfferBookmark", mappedBy="idUser")
     */
    private $bookmark;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;


    public function __construct()
    {
        $this->isActive = true;
        $this->createdDate = new \DateTime();
        $this->updatedDate = new \DateTime();
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function setCreatedDateValue(){
        $this->createdDate = new \DateTime();
    }

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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return User
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return User
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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return User
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
     * @return User
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
     * Add sellerTransaction
     *
     * @param \AppBundle\Entity\Transaction $sellerTransaction
     *
     * @return User
     */
    public function addSellerTransaction(\AppBundle\Entity\Transaction $sellerTransaction)
    {
        $this->sellerTransaction[] = $sellerTransaction;

        return $this;
    }

    /**
     * Remove sellerTransaction
     *
     * @param \AppBundle\Entity\Transaction $sellerTransaction
     */
    public function removeSellerTransaction(\AppBundle\Entity\Transaction $sellerTransaction)
    {
        $this->sellerTransaction->removeElement($sellerTransaction);
    }

    /**
     * Get sellerTransaction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSellerTransaction()
    {
        return $this->sellerTransaction;
    }

    /**
     * Add buyerTransaction
     *
     * @param \AppBundle\Entity\Transaction $buyerTransaction
     *
     * @return User
     */
    public function addBuyerTransaction(\AppBundle\Entity\Transaction $buyerTransaction)
    {
        $this->buyerTransaction[] = $buyerTransaction;

        return $this;
    }

    /**
     * Remove buyerTransaction
     *
     * @param \AppBundle\Entity\Transaction $buyerTransaction
     */
    public function removeBuyerTransaction(\AppBundle\Entity\Transaction $buyerTransaction)
    {
        $this->buyerTransaction->removeElement($buyerTransaction);
    }

    /**
     * Get buyerTransaction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBuyerTransaction()
    {
        return $this->buyerTransaction;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add authorMessage
     *
     * @param \AppBundle\Entity\Message $authorMessage
     *
     * @return User
     */
    public function addAuthorMessage(\AppBundle\Entity\Message $authorMessage)
    {
        $this->authorMessage[] = $authorMessage;

        return $this;
    }

    /**
     * Remove authorMessage
     *
     * @param \AppBundle\Entity\Message $authorMessage
     */
    public function removeAuthorMessage(\AppBundle\Entity\Message $authorMessage)
    {
        $this->authorMessage->removeElement($authorMessage);
    }

    /**
     * Get authorMessage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthorMessage()
    {
        return $this->authorMessage;
    }

    /**
     * Add destMessage
     *
     * @param \AppBundle\Entity\Message $destMessage
     *
     * @return User
     */
    public function addDestMessage(\AppBundle\Entity\Message $destMessage)
    {
        $this->destMessage[] = $destMessage;

        return $this;
    }

    /**
     * Remove destMessage
     *
     * @param \AppBundle\Entity\Message $destMessage
     */
    public function removeDestMessage(\AppBundle\Entity\Message $destMessage)
    {
        $this->destMessage->removeElement($destMessage);
    }

    /**
     * Get destMessage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDestMessage()
    {
        return $this->destMessage;
    }

    /**
     * Add notification
     *
     * @param \AppBundle\Entity\Notification $notification
     *
     * @return User
     */
    public function addNotification(\AppBundle\Entity\Notification $notification)
    {
        $this->notification[] = $notification;

        return $this;
    }

    /**
     * Remove notification
     *
     * @param \AppBundle\Entity\Notification $notification
     */
    public function removeNotification(\AppBundle\Entity\Notification $notification)
    {
        $this->notification->removeElement($notification);
    }

    /**
     * Get notification
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * Add offer
     *
     * @param \AppBundle\Entity\Offer $offer
     *
     * @return User
     */
    public function addOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offer[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \AppBundle\Entity\Offer $offer
     */
    public function removeOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offer->removeElement($offer);
    }

    /**
     * Get offer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Add bookmark
     *
     * @param \AppBundle\Entity\User $bookmark
     *
     * @return User
     */
    public function addBookmark(\AppBundle\Entity\User $bookmark)
    {
        $this->bookmark[] = $bookmark;

        return $this;
    }

    /**
     * Remove bookmark
     *
     * @param \AppBundle\Entity\User $bookmark
     */
    public function removeBookmark(\AppBundle\Entity\User $bookmark)
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
}
