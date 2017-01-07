<?php

namespace CAF\CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plats
 *
 * @ORM\Table(name="plats")
 * @ORM\Entity(repositoryClass="CAF\CantineBundle\Repository\PlatsRepository")
 */
class Plats
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
     * @ORM\ManyToOne(targetEntity="CAF\CantineBundle\Entity\TypePlat", inversedBy="plats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typePlat;

    /**
     * @var bool
     *
     * @ORM\Column(name="porc", type="boolean")
     */
    private $porc;


    

    /**
     * Get id
     *
     * @return integer
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
     * @return Plats
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
     * Set porc
     *
     * @param boolean $porc
     *
     * @return Plats
     */
    public function setPorc($porc)
    {
        $this->porc = $porc;

        return $this;
    }

    /**
     * Get porc
     *
     * @return boolean
     */
    public function getPorc()
    {
        return $this->porc;
    }

    /**
     * Set typePlat
     *
     * @param \CAF\CantineBundle\Entity\TypePlat $typePlat
     *
     * @return Plats
     */
    public function setTypePlat(\CAF\CantineBundle\Entity\TypePlat $typePlat)
    {
        $this->typePlat = $typePlat;

        return $this;
    }

    /**
     * Get typePlat
     *
     * @return \CAF\CantineBundle\Entity\TypePlat
     */
    public function getTypePlat()
    {
        return $this->typePlat;
    }
}
