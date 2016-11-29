<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Exception;

/**
 * Click
 *
 * @ORM\Table(name="click")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClickRepository")
 */
class Click
{    
    /**
    * @ORM\Id
    * @ORM\Column(type="string", length=255)
    */
    private $id;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="ua", type="string", length=255, nullable=false)
     */
    private $ua;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @Assert\Ip()
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=false)
     */
    private $ip;

    /**
     * @var string
     * 
     * @Assert\Url()
     *
     * @ORM\Column(name="ref", type="string", length=255, nullable=false)
     */
    private $ref;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="param1", type="string", length=255, nullable=false)
     */
    private $param1;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="param2", type="string", length=255, nullable=true)
     */
    private $param2;

    /**
     * @var string
     *
     * @ORM\Column(name="error", type="string", length=255, nullable=true)
     */
    private $error;

    /**
     * @var int
     *
     * @ORM\Column(name="bad_domain", type="integer", nullable=true)
     */
    private $badDomain;

    
    /**
     * Set id
     *
     * @param string $id
     *
     * @return Click
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ua
     *
     * @param string $ua
     *
     * @return Click
     */
    public function setUa($ua)
    {
        $this->ua = $ua;

        return $this;
    }

    /**
     * Get ua
     *
     * @return string
     */
    public function getUa()
    {
        return $this->ua;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Click
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set ref
     *
     * @param string $ref
     *
     * @return Click
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set param1
     *
     * @param string $param1
     *
     * @return Click
     */
    public function setParam1($param1)
    {
        $this->param1 = $param1;

        return $this;
    }

    /**
     * Get param1
     *
     * @return string
     */
    public function getParam1()
    {
        return $this->param1;
    }

    /**
     * Set param2
     *
     * @param string $param2
     *
     * @return Click
     */
    public function setParam2($param2)
    {
        $this->param2 = $param2;

        return $this;
    }

    /**
     * Get param2
     *
     * @return string
     */
    public function getParam2()
    {
        return $this->param2;
    }

    /**
     * Set error
     *
     * @param integer $error
     *
     * @return Click
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Get error
     *
     * @return int
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set badDomain
     *
     * @param string $badDomain
     *
     * @return Click
     */
    public function setBadDomain($badDomain)
    {
        $this->badDomain = $badDomain;

        return $this;
    }

    /**
     * Get badDomain
     *
     * @return string
     */
    public function getBadDomain()
    {
        return $this->badDomain;
    }
}

