<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notice
 *
 * @ORM\Table(name="notice")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoticeRepository")
 */
class Notice
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="notices")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Spot", inversedBy="notices")
     */
    protected $spot;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="smallint")
     */
    protected $note;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    protected $comment;


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
     * Set note
     *
     * @param integer $note
     *
     * @return Notice
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Notice
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }


}

