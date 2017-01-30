<?php

namespace CAF\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plat
 *
 * @ORM\Table(name="test_plat")
 * @ORM\Entity(repositoryClass="CAF\TestBundle\Repository\PlatRepository")
 */

class Plat
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
     * @ORM\Column(name="libelle", type="string", length=255, unique=true)
     */
    private $libelle;
    
    /**
     * @ORM\OneToMany(targetEntity="CAF\TestBundle\Entity\MenuPlat", mappedBy="plat")
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Plat
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mp = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add mp
     *
     * @param \CAF\TestBundle\Entity\MenuPlat $mp
     *
     * @return Plat
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
