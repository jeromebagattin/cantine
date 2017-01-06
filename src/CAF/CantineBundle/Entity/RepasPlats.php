<?php

namespace CAF\CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RepasPlats
 *
 * @ORM\Table(name="repas_plats")
 * @ORM\Entity(repositoryClass="CAF\CantineBundle\Repository\RepasPlatsRepository")
 */
class RepasPlats
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
     * @ORM\ManyToOne(targetEntity="CAF\CantineBundle\Entity\Repas", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $repas;
    
     /**
     * @ORM\ManyToOne(targetEntity="CAF\CantineBundle\Entity\Plats", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $plats;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="Lettre", type="string", length=1)
     */
    private $lettre;


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
     * @return RepasPlats
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
     * Set repas
     *
     * @param \CAF\CantineBundle\Entity\Repas $repas
     *
     * @return RepasPlats
     */
    public function setRepas(\CAF\CantineBundle\Entity\Repas $repas)
    {
        $this->repas = $repas;

        return $this;
    }

    /**
     * Get repas
     *
     * @return \CAF\CantineBundle\Entity\Repas
     */
    public function getRepas()
    {
        return $this->repas;
    }

    /**
     * Set plats
     *
     * @param \CAF\CantineBundle\Entity\Plat $plats
     *
     * @return RepasPlats
     */
    public function setPlats(\CAF\CantineBundle\Entity\Plat $plats)
    {
        $this->plats = $plats;

        return $this;
    }

    /**
     * Get plats
     *
     * @return \CAF\CantineBundle\Entity\Plat
     */
    public function getPlats()
    {
        return $this->plats;
    }
}
