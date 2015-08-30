<?php
// src/Medhelp/MedhelpBundle/Entity/Patient.php

namespace Medhelp\MedhelpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Patient {
     /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     private $id;

     /**
     * @ORM\Column(type="string", length=255)
     */
     private $firstName;

     /**
     * @ORM\Column(type="string", length=255)
     */
     private $lastName;

     /**
     * @ORM\OneToMany(targetEntity="Diagnosis", mappedBy="patient")
     */
     private $diagnoses;

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
     * Set firstName
     *
     * @param string $firstName
     * @return Patient
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Patient
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diagnoses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diagnoses
     *
     * @param \AppBundle\Entity\Diagnosis $diagnoses
     * @return Patient
     */
    public function addDiagnosis(\AppBundle\Entity\Diagnosis $diagnoses)
    {
        $this->diagnoses[] = $diagnoses;

        return $this;
    }

    /**
     * Remove diagnoses
     *
     * @param \AppBundle\Entity\Diagnosis $diagnoses
     */
    public function removeDiagnosis(\AppBundle\Entity\Diagnosis $diagnoses)
    {
        $this->diagnoses->removeElement($diagnoses);
    }

    /**
     * Get diagnoses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiagnoses()
    {
        return $this->diagnoses;
    }
}
