<?php

namespace CAF\CantineBundle\Entity;

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
     */
    private $dateMenu;


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
}

