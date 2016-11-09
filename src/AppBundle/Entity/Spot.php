<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Spot
 *
 * @ORM\Table(name="spot")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpotRepository")
 */
class Spot
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="spots")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Notice", mappedBy="spot")
     */
    protected $notices;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="spot")
     */
    protected $comments;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="spot")
     */
    protected $items;

    public function __construct()
    {
        $this->notices = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=30)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="imageTitle", type="string", length=255)
     */
    protected $imageTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;


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
     * @return Spot
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
     * Set imageTitle
     *
     * @param string $imageTitle
     *
     * @return Spot
     */
    public function setImageTitle($imageTitle)
    {
        $this->imageTitle = $imageTitle;

        return $this;
    }

    /**
     * Get imageTitle
     *
     * @return string
     */
    public function getImageTitle()
    {
        return $this->imageTitle;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Spot
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Spot
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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return ArrayCollection
     */
    public function getNotices()
    {
        return $this->notices;
    }

    /**
     * @param ArrayCollection $notices
     */
    public function setNotices($notices)
    {
        $this->notices = $notices;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param ArrayCollection $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ArrayCollection $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    


}
