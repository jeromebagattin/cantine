<?php

namespace CAF\CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenusPlats
 *
 * @ORM\Table(name="menus_plats")
 * @ORM\Entity(repositoryClass="CAF\CantineBundle\Repository\MenusPlatsRepository")
 */
class MenusPlats
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
     * @ORM\ManyToOne(targetEntity="CAF\CantineBundle\Entity\Menus", inversedBy="menus_r", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $menus;
    
     /**
     * @ORM\ManyToOne(targetEntity="CAF\CantineBundle\Entity\Plats", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $plats;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lettre", type="string", length=1)
     */
    private $lettre;


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
     * Set lettre
     *
     * @param string $lettre
     *
     * @return MenusPlats
     */
    public function setLettre($lettre)
    {
        $this->lettre = $lettre;

        return $this;
    }

    /**
     * Get lettre
     *
     * @return string
     */
    public function getLettre()
    {
        return $this->lettre;
    }

    /**
     * Set menus
     *
     * @param \CAF\CantineBundle\Entity\Menus $menus
     *
     * @return MenusPlats
     */
    public function setMenus(\CAF\CantineBundle\Entity\Menus $menus)
    {
        $this->menus = $menus;

        return $this;
    }

    /**
     * Get menus
     *
     * @return \CAF\CantineBundle\Entity\Menus
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Set plats
     *
     * @param \CAF\CantineBundle\Entity\Plats $plats
     *
     * @return MenusPlats
     */
    public function setPlats(\CAF\CantineBundle\Entity\Plats $plats)
    {
        $this->plats = $plats;

        return $this;
    }

    /**
     * Get plats
     *
     * @return \CAF\CantineBundle\Entity\Plats
     */
    public function getPlats()
    {
        return $this->plats;
    }
}
