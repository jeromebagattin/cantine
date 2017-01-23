<?php

namespace CAF\PopoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * TypePlat
 *
 * @ORM\Table(name="type_plat")
 * @ORM\Entity(repositoryClass="CAF\PopoteBundle\Repository\TypePlatRepository")
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, unique=true)
     * @Assert\Length(min=3, minMessage="Le type de plat doit faire au moins {{ limit }} caractères.")
     */
    private $libelle;
    
    /**
     * @ORM\OneToMany(targetEntity="CAF\PopoteBundle\Entity\Plat", mappedBy="typePlat")
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
     * @param \CAF\PopoteBundle\Entity\Plat $plat
     *
     * @return TypePlat
     */
    public function addPlat(\CAF\PopoteBundle\Entity\Plat $plat)
    {
        $this->plats[] = $plat;

        return $this;
    }

    /**
     * Remove plat
     *
     * @param \CAF\PopoteBundle\Entity\Plat $plat
     */
    public function removePlat(\CAF\PopoteBundle\Entity\Plat $plat)
    {
        $this->plats->removeElement($plat);
    }

    /**
     * Get plat
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlat()
    {
        return $this->plat;
    }
}
