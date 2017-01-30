<?php

namespace CAF\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="test_menu")
 * @ORM\Entity(repositoryClass="CAF\TestBundle\Repository\MenuRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"menu" = "Menu", "repa" = "Repa"})
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
     */
    private $dateMenu;

    private $plats; 
    
    /**                                                                                                                                                                                                          
     * @ORM\OneToMany(targetEntity="CAF\TestBundle\Entity\MenuPlat", cascade={"persist"}, mappedBy="menu")                                                                                                                      
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
     * Constructor
     */
    public function __construct()
    {
        $this->mp = new \Doctrine\Common\Collections\ArrayCollection();
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
            $mp->setSelectionne(false);
                                                                                                                                                                                                                 
            $this->addMp($mp);                                                                                                                                                                                   
        }          
    }
    
    /**
     * Add mp
     *
     * @param \CAF\TestBundle\Entity\MenuPlat $mp
     *
     * @return Menu
     */
    public function addMp(\CAF\TestBundle\Entity\MenuPlat $mp)
    {
        $this->mp[] = $mp;

        return $this;
    }

    /**
     * Remove mp
     *
     * @param \CAF\TestBundle\Entity\MenuPlat $mp
     */
    public function removeMp(\CAF\TestBundle\Entity\MenuPlat $mp)
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
