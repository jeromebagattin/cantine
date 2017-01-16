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
     * @ORM\OneToMany(targetEntity="CAF\CantineBundle\Entity\MenusPlats", mappedBy="menus")
     */
    private $menus_r;

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
        $this->menus_r = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add menusR
     *
     * @param \CAF\CantineBundle\Entity\MenusPlats $menusR
     *
     * @return Menus
     */
    public function addMenusR(\CAF\CantineBundle\Entity\MenusPlats $menusR)
    {
        $this->menus_r[] = $menusR;

        return $this;
    }

    /**
     * Remove menusR
     *
     * @param \CAF\CantineBundle\Entity\MenusPlats $menusR
     */
    public function removeMenusR(\CAF\CantineBundle\Entity\MenusPlats $menusR)
    {
        $this->menus_r->removeElement($menusR);
    }

    /**
     * Get menusR
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenusR()
    {
        return $this->menus_r;
    }
}
