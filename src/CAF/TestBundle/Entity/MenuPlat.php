<?php

namespace CAF\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuPlat
 *
 * @ORM\Table(name="test_menu_plat")
 * @ORM\Entity(repositoryClass="CAF\TestBundle\Repository\MenuPlatRepository")
 */
class MenuPlat
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
     * @var string
     *
     * @ORM\Column(name="lettre", type="string", length=1, nullable=true)
     */
    private $lettre;

    /**
     * @var bool
     *
     * @ORM\Column(name="selectionne", type="boolean")
     */
    private $selectionne;
    
     /**
     * @ORM\ManyToOne(targetEntity="CAF\TestBundle\Entity\Menu", inversedBy="mp", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;
    
     /**
     * @ORM\ManyToOne(targetEntity="CAF\TestBundle\Entity\Plat", inversedBy="mp", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $plat;


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
     * @return MenuPlat
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
     * Set selectionne
     *
     * @param boolean $selectionne
     *
     * @return MenuPlat
     */
    public function setSelectionne($selectionne)
    {
        $this->selectionne = $selectionne;

        return $this;
    }

    /**
     * Get selectionne
     *
     * @return bool
     */
    public function getSelectionne()
    {
        return $this->selectionne;
    }

    /**
     * Set menu
     *
     * @param \CAF\TestBundle\Entity\Menu $menu
     *
     * @return MenuPlat
     */
    public function setMenu(\CAF\TestBundle\Entity\Menu $menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \CAF\TestBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set plat
     *
     * @param \CAF\TestBundle\Entity\Plat $plat
     *
     * @return MenuPlat
     */
    public function setPlat(\CAF\TestBundle\Entity\Plat $plat)
    {
        $this->plat = $plat;

        return $this;
    }

    /**
     * Get plat
     *
     * @return \CAF\TestBundle\Entity\Plat
     */
    public function getPlat()
    {
        return $this->plat;
    }
}
