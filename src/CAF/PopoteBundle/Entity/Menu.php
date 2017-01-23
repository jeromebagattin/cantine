<?php

namespace CAF\PopoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;                                                                                                                                                            
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="CAF\PopoteBundle\Repository\MenuRepository")
 */
class Menu
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateMenu", type="date", unique=true)
     * @Assert\Date() 
     */
    private $dateMenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValidation", type="date")
     * @Assert\Date() 
     */
    private $dateValidation;

    private $plats; 
    
    /**                                                                                                                                                                                                          
     * @ORM\OneToMany(targetEntity="CAF\PopoteBundle\Entity\MenuPlat", cascade={"persist"}, mappedBy="menu")                                                                                                                      
     */                                                                                                                                                                                                          
    private $mp; 

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
     * Set dateMenu
     *
     * @param \DateTime $dateMenu
     *
     * @return Menu
     */
    public function setDateMenu($dateMenu)
    {
        $this->dateMenu = $dateMenu;

        return $this;
    }

    /**
     * Get dateMenu
     *
     * @return \DateTime
     */
    public function getDateMenu()
    {
        return $this->dateMenu;
    }

    /**
     * Set dateValidation
     *
     * @param \DateTime $dateValidation
     *
     * @return Menu
     */
    public function setDateValidation($dateValidation)
    {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    /**
     * Get dateValidation
     *
     * @return \DateTime
     */
    public function getDateValidation()
    {
        return $this->dateValidation;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mp = new \Doctrine\Common\Collections\ArrayCollection();
        $this->plats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getPlats()                                                                                                                                                                                   
    {                                                                                                                                                                                                            
        $plats = new \Doctrine\Common\Collections\ArrayCollection();                                                                                                                                             
                                                                                                                                                                                                                 
        foreach($this->mp as $p)                                                                                                                                                                                 
        {                                                                                                                                                                                                        
            $plats[] = $p->getPlat();                                                                                                                                                                           
        }                                                                                                                                                                                                        
                                                                                                                                                                                                                 
        return $plats;                                                                                                                                                                                           
    }                                                                                                                                                                                                            
                                                                                                                                                                                                                 
    public function setPlats($plats)                                                                                                                                                                             
    {                                                                                                                                                                                                            
        foreach($plats as $p)                                                                                                                                                                                    
        {                                                                                                                                                                                                        
            $mp = new MenuPlat();                                                                                                                                                                               
                                                                                                                                                                                                                 
            $mp->setMenu($this);                                                                                                                                                                                
            $mp->setPlat($p); 
            $mp->setLettre('_'); 
                                                                                                                                                                                                                 
            $this->addMp($mp);                                                                                                                                                                                   
        }          
    }
    
    /**
     * Add mp
     *
     * @param \CAF\PopoteBundle\Entity\MenuPlat $mp
     *
     * @return Menu
     */
    public function addMp(\CAF\PopoteBundle\Entity\MenuPlat $mp)
    {
        $this->mp[] = $mp;

        return $this;
    }

    /**
     * Remove mp
     *
     * @param \CAF\PopoteBundle\Entity\MenuPlat $mp
     */
    public function removeMp(\CAF\PopoteBundle\Entity\MenuPlat $mp)
    {
        $this->mp->removeElement($mp);
    }

    /**
     * Get mp
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMp()
    {
        return $this->mp;
    }
}
