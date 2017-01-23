<?php

namespace CAF\PopoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Plat
 *
 * @ORM\Table(name="plat")
 * @ORM\Entity(repositoryClass="CAF\PopoteBundle\Repository\PlatRepository")
 * @UniqueEntity(fields="libelle", message="Ce plat existe déjà.")
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
     * @Assert\Length(min=3)
     */
    private $libelle;

    /**
     * @var bool
     *
     * @ORM\Column(name="porc", type="boolean")
     * @Assert\Type("bool")
     */
    private $porc;

    /**
     * @ORM\ManyToOne(targetEntity="CAF\PopoteBundle\Entity\TypePlat", inversedBy="plat", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $typePlat;

     /**
     * @ORM\OneToMany(targetEntity="CAF\PopoteBundle\Entity\MenuPlat", mappedBy="plat")
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
     * Set porc
     *
     * @param boolean $porc
     *
     * @return Plat
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

    /**
     * Set typePlat
     *
     * @param \CAF\PopoteBundle\Entity\TypePlat $typePlat
     *
     * @return Plat
     */
    public function setTypePlat(\CAF\PopoteBundle\Entity\TypePlat $typePlat)
    {
        $this->typePlat = $typePlat;

        return $this;
    }

    /**
     * Get typePlat
     *
     * @return \CAF\PopoteBundle\Entity\TypePlat
     */
    public function getTypePlat()
    {
        return $this->typePlat;
    }
}
