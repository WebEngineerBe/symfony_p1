<?php

namespace WE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestEvents
 *
 * @ORM\Table(name="we_log_event")
 * @ORM\Entity(repositoryClass="WE\TestBundle\Repository\TestServicesRepository")
 */
class LogEvent
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
     * @ORM\Column(name="name", type="string", length=20)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="o", type="string", length=255, nullable=true)
     */
    private $o;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date;
    
    public function __construct()
    {
        $this->date = new \DateTime();
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
     * Set name
     *
     * @param string $name
     *
     * @return LogEvent
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
     * Set o
     *
     * @param string $o
     *
     * @return LogEvent
     */
    public function setO($o)
    {
        $this->o = $o;

        return $this;
    }

    /**
     * Get o
     *
     * @return string
     */
    public function getO()
    {
        return $this->o;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogEvent
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
}
