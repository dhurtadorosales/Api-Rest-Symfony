<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Diary
 *
 * @ORM\Table(name="diary")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiaryRepository")
 */
class Diary
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type ="string")
     */
    private $description;

    /**
     * @var Availability
     *
     * @ORM\ManyToOne(targetEntity="Availability", inversedBy="diaries")
     * @ORM\JoinColumn(name="availability_id", referencedColumnName="id")
     */
    private $availability;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="diaries")
     */
    private $user;

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
     * Set description
     *
     * @param string $description
     *
     * @return Diary
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
     * Set availability
     *
     * @param \AppBundle\Entity\Availability $availability
     *
     * @return Diary
     */
    public function setAvailability(\AppBundle\Entity\Availability $availability = null)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return \AppBundle\Entity\Availability
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Diary
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
