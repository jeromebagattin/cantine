<?php

namespace CAF\PopoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RepaPlat
 *
 * @ORM\Table(name="repa_plat")
 * @ORM\Entity(repositoryClass="CAF\PopoteBundle\Repository\RepaPlatRepository")
 */
class RepaPlat
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
     * @ORM\ManyToOne(targetEntity="CAF\PopoteBundle\Entity\Repa", inversedBy="rp", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $repa;
    
     /**
     * @ORM\ManyToOne(targetEntity="CAF\PopoteBundle\Entity\Plat", inversedBy="rp", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $plat;


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
     * Set lettre
     *
     * @param string $lettre
     *
     * @return RepaPlat
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
     * Set repa
     *
     * @param \CAF\PopoteBundle\Entity\Repa $repa
     *
     * @return RepaPlat
     */
    public function setRepa(\CAF\PopoteBundle\Entity\Repa $repa)
    {
        $this->repa = $repa;

        return $this;
    }

    /**
     * Get repa
     *
     * @return \CAF\PopoteBundle\Entity\Repa
     */
    public function getRepa()
    {
        return $this->repa;
    }

    /**
     * Set plat
     *
     * @param \CAF\PopoteBundle\Entity\Plat $plat
     *
     * @return RepaPlat
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
