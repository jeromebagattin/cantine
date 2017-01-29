<?php

namespace CAF\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * 
 * @ORM\Entity(repositoryClass="CAF\TestBundle\Repository\RepaRepository")
 */
class Repa extends Menu
{
    /**
     * @var string
     *
     * @ORM\Column(name="agent", type="string", length=255, nullable=true)
     */
    private $agent;

    /**
     * Set agent
     *
     * @param string $agent
     *
     * @return repa
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return string
     */
    public function getAgent()
    {
        return $this->agent;
    }
}
