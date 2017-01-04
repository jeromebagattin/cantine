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
     * @var int
     *
     * @ORM\Column(name="typePlat", type="integer")
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
     * Set typePlat
     *
     * @param integer $typePlat
     *
     * @return Plats
     */
    public function setType($typePlat)
    {
        $this->typePlat = $typePlat;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->typePlat;
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
     * @return bool
     */
    public function getPorc()
    {
        return $this->porc;
    }
}

