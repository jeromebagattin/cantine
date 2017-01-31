<?php

namespace CAF\PopoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;                                                                                                                                                            


/**
 *
 * @ORM\Entity(repositoryClass="CAF\PopoteBundle\Repository\RepaRepository")
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
     * @var float
     *
     * @ORM\Column(name="prixRepa", type="float")
     */
    private $prixRepa;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", options={"default":0})
     */
    private $etat = 0;

    public function __construct(\CAF\PopoteBundle\Entity\Menu $menu) 
    {
        
        
        if (is_a($menu, '\CAF\PopoteBundle\Entity\Menu')) {
            $this->dateMenu = $menu->getDateMenu();
            $this->dateValidation = $menu->getDateValidation();
            foreach ($menu->getMp() as $mp) {
                $this->mp[] = $mp;
            }
        }
    }
    
    /**
     * Set prixRepa
     *
     * @param float $prixRepa
     *
     * @return Repa
     */
    public function setPrixRepa($prixRepa)
    {
        $this->prixRepa = $prixRepa;

        return $this;
    }

    /**
     * Get prixRepa
     *
     * @return float
     */
    public function getPrixRepa()
    {
        return $this->prixRepa;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Repa
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set agent
     *
     * @param string $agent
     *
     * @return Repa
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
