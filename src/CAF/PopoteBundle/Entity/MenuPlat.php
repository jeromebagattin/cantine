<?php

namespace CAF\PopoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuPlat
 *
 * @ORM\Table(name="menu_plat")
 * @ORM\Entity(repositoryClass="CAF\PopoteBundle\Repository\MenuPlatRepository")
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
     * @ORM\Column(name="lettre", type="string", length=1)
     */
    private $lettre;

     /**
     * @ORM\ManyToOne(targetEntity="CAF\PopoteBundle\Entity\Menu", inversedBy="mp", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;
    
     /**
     * @ORM\ManyToOne(targetEntity="CAF\PopoteBundle\Entity\Plat", inversedBy="mp", cascade={"persist"})
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
     * Set menu
     *
     * @param \CAF\PopoteBundle\Entity\Menu $menu
     *
     * @return MenuPlat
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

    /**
     * Set plat
     *
     * @param \CAF\PopoteBundle\Entity\Plat $plat
     *
     * @return MenuPlat
     */
    public function setPlat(\CAF\PopoteBundle\Entity\Plat $plat)
    {
        $this->plat = $plat;

        return $this;
    }

    /**
     * Get plat
     *
     * @return \CAF\PopoteBundle\Entity\Plat
     */
    public function getPlat()
    {
        return $this->plat;
    }
}
