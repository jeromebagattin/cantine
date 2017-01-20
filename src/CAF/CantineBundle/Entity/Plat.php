<?php

namespace CAF\CantineBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * plat
 *
 * @ORM\Table(name="plat")
 * @ORM\Entity(repositoryClass="CAF\CantineBundle\Repository\platRepository")
 * @UniqueEntity(fields="libelle", message="Ce plat existe déjà.")
 */
class plat {

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
     * @Assert\Length(min=3)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="CAF\CantineBundle\Entity\TypePlat", inversedBy="plat", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $typePlat;

    /**
     * @var bool
     *
     * @ORM\Column(name="porc", type="boolean")
     * @Assert\Type("bool")
     */
    private $porc;

    /**
     * @ORM\OneToMany(targetEntity="CAF\CantineBundle\Entity\Menusplat", mappedBy="plat")
     */
    private $mp;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return plat
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Set porc
     *
     * @param boolean $porc
     *
     * @return plat
     */
    public function setPorc($porc) {
        $this->porc = $porc;

        return $this;
    }

    /**
     * Get porc
     *
     * @return boolean
     */
    public function getPorc() {
        return $this->porc;
    }

    /**
     * Set typePlat
     *
     * @param \CAF\CantineBundle\Entity\TypePlat $typePlat
     *
     * @return plat
     */
    public function setTypePlat(\CAF\CantineBundle\Entity\TypePlat $typePlat) {
        $this->typePlat = $typePlat;

        return $this;
    }

    /**
     * Get typePlat
     *
     * @return \CAF\CantineBundle\Entity\TypePlat
     */
    public function getTypePlat() {
        return $this->typePlat;
    }

}
