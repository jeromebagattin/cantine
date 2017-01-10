<?php

namespace CAF\CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * TypePlat
 *
 * @ORM\Table(name="type_plat")
 * @ORM\Entity(repositoryClass="CAF\CantineBundle\Repository\TypePlatRepository")
 * @UniqueEntity(fields="libelle", message="Ce type de plat existe déjà.")
 */
class TypePlat
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
     * @ORM\OneToMany(targetEntity="CAF\CantineBundle\Entity\Plats", mappedBy="typePlat")
     */
    private $plats;
    
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, unique=true)
     * @Assert\Length(min=3, minMessage="Le type de plat doit faire au moins {{ limit }} caractères.")
     */
    private $libelle;


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
     * @return TypePlat
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
        $this->plats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add plat
     *
     * @param \CAF\CantineBundle\Entity\Plats $plat
     *
     * @return TypePlat
     */
    public function addPlat(\CAF\CantineBundle\Entity\Plats $plat)
    {
        $this->plats[] = $plat;

        return $this;
    }

    /**
     * Remove plat
     *
     * @param \CAF\CantineBundle\Entity\Plats $plat
     */
    public function removePlat(\CAF\CantineBundle\Entity\Plats $plat)
    {
        $this->plats->removeElement($plat);
    }

    /**
     * Get plats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlats()
    {
        return $this->plats;
    }
}
