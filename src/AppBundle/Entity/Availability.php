<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Availability
 * @ORM\Table(name="availability")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvailabilityRepository")
 */
class Availability
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var \DateTime
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @var Diary[]
     * @ORM\OneToMany(targetEntity="Diary", mappedBy="availability")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diaries;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diaries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Availability
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
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Availability
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Add diary
     *
     * @param \AppBundle\Entity\Diary $diary
     *
     * @return Availability
     */
    public function addDiary(\AppBundle\Entity\Diary $diary)
    {
        $this->diaries[] = $diary;

        return $this;
    }

    /**
     * Remove diary
     *
     * @param \AppBundle\Entity\Diary $diary
     */
    public function removeDiary(\AppBundle\Entity\Diary $diary)
    {
        $this->diaries->removeElement($diary);
    }

    /**
     * Get diaries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiaries()
    {
        return $this->diaries;
    }
}
