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
    
    private $idMenu;

    public function __construct(\CAF\PopoteBundle\Entity\Menu $menu) 
    {
        if (is_a($menu, '\CAF\PopoteBundle\Entity\Menu')) {
            $this->idMenu = $menu->getId();
            $this->setDateMenu($menu->getDateMenu());
            $this->setDateValidation($menu->getDateValidation());
            $this->setEtat($menu->getEtat());
            
//            foreach ($menu->getMp() as $mp) {
//                 $this->addMp($mp);
//            }
        }
    }
    
    public function getIdMenu() {
        return $this->idMenu;
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
