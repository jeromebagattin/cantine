<?php

namespace CAF\CantineBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Menus
 *
 * @ORM\Table(name="menus")
 * @ORM\Entity(repositoryClass="CAF\CantineBundle\Repository\MenusRepository")
 */
class Menus
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
     * @ORM\Column(name="dateMenu", type="date")
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
    
    /**
     * @ORM\OneToMany(targetEntity="CAF\CantineBundle\Entity\MenusPlats", mappedBy="menus")
     */
    private $mp;
    
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
     * Set dateMenu
     *
     * @param \DateTime $dateMenu
     *
     * @return Menus
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
     * @return Menus
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
            $plats[] = $p->getPlats();
        }

        return $plats;
    }
    
    // Important
    public function setPlats($plats)
    {
        foreach($plats as $p)
        {
            $mp = new MenuPlats();

            $mp->setMenus($this);
            $mp->setPlats($p);

            $this->addMp($mp);
        }

    }

    public function getMenus()
    {
        return $this;
    }
    
    /**
     * Add mp
     *
     * @param \CAF\CantineBundle\Entity\MenusPlats $mp
     *
     * @return Menus
     */
    public function addMp(\CAF\CantineBundle\Entity\MenusPlats $mp)
    {
        $this->mp[] = $mp;

        return $this;
    }

    /**
     * Remove mp
     *
     * @param \CAF\CantineBundle\Entity\MenusPlats $mp
     */
    public function removeMp(\CAF\CantineBundle\Entity\MenusPlats $mp)
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
