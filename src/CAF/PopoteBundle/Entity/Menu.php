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
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"menu" = "Menu", "repa" = "Repa"})
 * 
 */
class Menu {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateMenu", type="date")
     * @Assert\Date() 
     */
    protected $dateMenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValidation", type="date")
     * @Assert\Date() 
     */
    protected $dateValidation;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", options={"default":0})
     */
    protected $etat = 0;
    protected $plats;

    /**
     * @ORM\OneToMany(targetEntity="CAF\PopoteBundle\Entity\MenuPlat", cascade={"persist"}, mappedBy="menu")                                                                                                                      
     */
    protected $mp;

    /**
     * Constructor
     */
    public function __construct() {
        $this->mp = new \Doctrine\Common\Collections\ArrayCollection();
        $this->plats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dateMenu
     *
     * @param \DateTime $dateMenu
     *
     * @return Menu
     */
    public function setDateMenu($dateMenu) {
        $this->dateMenu = $dateMenu;

        return $this;
    }

    /**
     * Get dateMenu
     *
     * @return \DateTime
     */
    public function getDateMenu() {
        return $this->dateMenu;
    }

    /**
     * Set dateValidation
     *
     * @param \DateTime $dateValidation
     *
     * @return Menu
     */
    public function setDateValidation($dateValidation) {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    /**
     * Get dateValidation
     *
     * @return \DateTime
     */
    public function getDateValidation() {
        return $this->dateValidation;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Menu
     */
    public function setEtat($etat) {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat() {
        return $this->etat;
    }

    public function getPlats() {
        $plats = new \Doctrine\Common\Collections\ArrayCollection();

        if (!empty($this->mp)) {
            foreach ($this->mp as $p) {
                $plats[] = $p->getPlat();
            }
        }

        return $plats;
    }

    public function setPlats($plats) {
        foreach ($plats as $p) {
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
     * @param \CAF\PopoteBundle\Entity\MenuPlat $mp
     *
     * @return Menu
     */
    public function addMp(\CAF\PopoteBundle\Entity\MenuPlat $mp) {
        $this->mp[] = $mp;

        return $this;
    }

    /**
     * Remove mp
     *
     * @param \CAF\PopoteBundle\Entity\MenuPlat $mp
     */
    public function removeMp(\CAF\PopoteBundle\Entity\MenuPlat $mp) {
        $this->mp->removeElement($mp);
    }

    /**
     * Get mp
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMp() {
        return $this->mp;
    }

}
