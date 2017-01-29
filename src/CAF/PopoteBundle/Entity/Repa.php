<?php

namespace CAF\PopoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;                                                                                                                                                            
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Repa
 *
 * @ORM\Table(name="repa")
 * @ORM\Entity(repositoryClass="CAF\PopoteBundle\Repository\RepaRepository")
 */
class Repa
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
     * @ORM\Column(name="dateRepa", type="date", unique=true)
     * @Assert\Date()
     */
    private $dateRepa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValidation", type="date")
     * @Assert\Date()
     */
    private $dateValidation;

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

     /**
     * @ORM\ManyToOne(targetEntity="CAF\PopoteBundle\Entity\Menu")
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;
    
     /**                                                                                                                                                                                                          
     * @ORM\OneToMany(targetEntity="CAF\PopoteBundle\Entity\RepaPlat", cascade={"persist"}, mappedBy="repa")                                                                                                                      
     */                                                                                                                                                                                                          
    private $rp; 
    
    private $plats;
    
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
     * Set dateRepa
     *
     * @param \DateTime $dateRepa
     *
     * @return Repa
     */
    public function setDateRepa($dateRepa)
    {
        $this->dateRepa = $dateRepa;

        return $this;
    }

    /**
     * Get dateRepa
     *
     * @return \DateTime
     */
    public function getDateRepa()
    {
        return $this->dateRepa;
    }

    /**
     * Set dateValidation
     *
     * @param \DateTime $dateValidation
     *
     * @return Repa
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
     * Constructor
     */
//    public function __construct()
//    {
//        $this->rp = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->plats = new \Doctrine\Common\Collections\ArrayCollection();
//    }
    
    public function __construct(\CAF\PopoteBundle\Entity\Menu $menu) 
    {
        $this->rp = new \Doctrine\Common\Collections\ArrayCollection();
        $this->plats = new \Doctrine\Common\Collections\ArrayCollection();
        
        if (is_a($menu, '\CAF\PopoteBundle\Entity\Menu')) {
            $this->dateRepa = $menu->getDateMenu();
            $this->dateValidation = $menu->getDateValidation();
            $this->menu = $menu;
        }
    }
    
    public function getPlats()                                                                                                                                                                                   
    {                                                                                                                                                                                                            
        $plats = new \Doctrine\Common\Collections\ArrayCollection();                                                                                                                                             
                                                                                                                                                                                                                 
        foreach($this->rp as $p)                                                                                                                                                                                 
        {                                                                                                                                                                                                        
            $plats[] = $p->getPlat();                                                                                                                                                                           
        }                                                                                                                                                                                                        
                                                                                                                                                                                                                 
        return $plats;                                                                                                                                                                                           
    }                                                                                                                                                                                                            
                                                                                                                                                                                                                 
    public function setPlats($plats)                                                                                                                                                                             
    {                                                                                                                                                                                                            
        foreach($plats as $p)                                                                                                                                                                                    
        {                                                                                                                                                                                                        
            $rp = new RepaPlat();                                                                                                                                                                               
                                                                                                                                                                                                                 
            $rp->setRepa($this);                                                                                                                                                                                
            $rp->setPlat($p); 
            $rp->setLettre('_'); 
                                                                                                                                                                                                                 
            $this->addRp($rp);                                                                                                                                                                                   
        }          
    }
    
    /**
     * Add rp
     *
     * @param \CAF\PopoteBundle\Entity\RepaPlat $rp
     *
     * @return Repa
     */
    public function addRp(\CAF\PopoteBundle\Entity\RepaPlat $rp)
    {
        $this->rp[] = $rp;

        return $this;
    }

    /**
     * Remove rp
     *
     * @param \CAF\PopoteBundle\Entity\RepaPlat $rp
     */
    public function removeRp(\CAF\PopoteBundle\Entity\RepaPlat $rp)
    {
        $this->rp->removeElement($rp);
    }

    /**
     * Get rp
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRp()
    {
        return $this->rp;
    }

    /**
     * Set menu
     *
     * @param \CAF\PopoteBundle\Entity\Menu $menu
     *
     * @return Repa
     */
    public function setMenu(\CAF\PopoteBundle\Entity\Menu $menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \CAF\PopoteBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }
}
