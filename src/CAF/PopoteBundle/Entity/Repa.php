<?php

namespace CAF\PopoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Repa
 *
 * @ORM\Table(name="repa")
 * @ORM\Entity(repositoryClass="CAF\PopoteBundle\Repository\RepaRepository")
 */
class Repa
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
     * @ORM\Column(name="dateRepa", type="datetime", unique=true)
     */
    private $dateRepa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValidation", type="datetime")
     */
    private $dateValidation;

    /**
     * @var float
     *
     * @ORM\Column(name="prixRepa", type="float")
     */
    private $prixRepa;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;


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
     * Set dateRepa
     *
     * @param \DateTime $dateRepa
     *
     * @return Repa
     */
    public function setDateRepa($dateRepa)
    {
        $this->dateRepa = $dateRepa;

        return $this;
    }

    /**
     * Get dateRepa
     *
     * @return \DateTime
     */
    public function getDateRepa()
    {
        return $this->dateRepa;
    }

    /**
     * Set dateValidation
     *
     * @param \DateTime $dateValidation
     *
     * @return Repa
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

    /**
     * Set prixRepa
     *
     * @param float $prixRepa
     *
     * @return Repa
     */
    public function setPrixRepa($prixRepa)
    {
        $this->prixRepa = $prixRepa;

        return $this;
    }

    /**
     * Get prixRepa
     *
     * @return float
     */
    public function getPrixRepa()
    {
        return $this->prixRepa;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Repa
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }
}

