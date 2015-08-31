<?php
// src/Medhelp/MedhelpBundle/Entity/Diagnosis.php

namespace Medhelp\MedhelpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Diagnosis {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $prescription;

    /**
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="diagnoses")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id")
     */
    private $patient;

     /**
      * @ORM\ManyToMany(targetEntity="Disease", inversedBy="diagnosis")
      * @ORM\JoinTable(name="Diagnosis_Disease")
      */
     private $disease;

     /**
      * @ORM\ManyToMany(targetEntity="Symptom", inversedBy="diagnosis")
      * @ORM\JoinTable(name="Diagnosis_Symptom")
      */
     private $symptom;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Diagnosis
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set prescription
     *
     * @param string $prescription
     * @return Diagnosis
     */
    public function setPrescription($prescription)
    {
        $this->prescription = $prescription;

        return $this;
    }

    /**
     * Get prescription
     *
     * @return string
     */
    public function getPrescription()
    {
        return $this->prescription;
    }

    /**
     * Set patient
     *
     * @param \Medhelp\MedhelpBundle\Entity\Patient $patient
     * @return Diagnosis
     */
    public function setPatient(\Medhelp\MedhelpBundle\Entity\Patient $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \Medhelp\MedhelpBundle\Entity\Patient
     */
    public function getPatient()
    {
        return $this->patient;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->disease = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add disease
     *
     * @param \Medhelp\MedhelpBundle\Entity\Disease $disease
     * @return Diagnosis
     */
    public function addDisease(\Medhelp\MedhelpBundle\Entity\Disease $disease)
    {
        $this->disease[] = $disease;

        return $this;
    }

    /**
     * Remove disease
     *
     * @param \Medhelp\MedhelpBundle\Entity\Disease $disease
     */
    public function removeDisease(\Medhelp\MedhelpBundle\Entity\Disease $disease)
    {
        $this->disease->removeElement($disease);
    }

    /**
     * Get disease
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDisease()
    {
        return $this->disease;
    }

    /**
     * Add symptom
     *
     * @param \Medhelp\MedhelpBundle\Entity\Symptom $symptom
     * @return Diagnosis
     */
    public function addSymptom(\Medhelp\MedhelpBundle\Entity\Symptom $symptom)
    {
        $this->symptom[] = $symptom;

        return $this;
    }

    /**
     * Remove symptom
     *
     * @param \Medhelp\MedhelpBundle\Entity\Symptom $symptom
     */
    public function removeSymptom(\Medhelp\MedhelpBundle\Entity\Symptom $symptom)
    {
        $this->symptom->removeElement($symptom);
    }

    /**
     * Get symptom
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSymptom()
    {
        return $this->symptom;
    }
}
