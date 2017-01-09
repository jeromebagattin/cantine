<?php

namespace CAF\CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Repas
 *
 * @ORM\Table(name="repas")
 * @ORM\Entity(repositoryClass="CAF\CantineBundle\Repository\RepasRepository")
 */
class Repas
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
     * @ORM\Column(name="dateRepas", type="date")
     */
    private $dateRepas;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValidation", type="date")
     */
    private $dateValidation;

    /**
     * @var float
     *
     * @ORM\Column(name="prixRepas", type="float")
     */
    private $prixRepas;


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
     * Set dateRepas
     *
     * @param \DateTime $dateRepas
     *
     * @return Repas
     */
    public function setDateRepas($dateRepas)
    {
        $this->dateRepas = $dateRepas;

        return $this;
    }

    /**
     * Get dateRepas
     *
     * @return \DateTime
     */
    public function getDateRepas()
    {
        return $this->dateRepas;
    }

    /**
     * Set prixRepas
     *
     * @param float $prixRepas
     *
     * @return Repas
     */
    public function setPrixRepas($prixRepas)
    {
        $this->prixRepas = $prixRepas;

        return $this;
    }

    /**
     * Get prixRepas
     *
     * @return float
     */
    public function getPrixRepas()
    {
        return $this->prixRepas;
    }

    /**
     * Set dateValidation
     *
     * @param \DateTime $dateValidation
     *
     * @return Repas
     */
    public function setDateValidation($dateValidation)
    {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    /**
     * Get dateValidation
     *
     * @return \DateTime
     */
    public function getDateValidation()
    {
        return $this->dateValidation;
    }
}
