<?php

namespace AppBundle\Entity;
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
     * @param \AppBundle\Entity\Patient $patient
     * @return Diagnosis
     */
    public function setPatient(\AppBundle\Entity\Patient $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \AppBundle\Entity\Patient
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
     * @param \AppBundle\Entity\Disease $disease
     * @return Diagnosis
     */
    public function addDisease(\AppBundle\Entity\Disease $disease)
    {
        $this->disease[] = $disease;

        return $this;
    }

    /**
     * Remove disease
     *
     * @param \AppBundle\Entity\Disease $disease
     */
    public function removeDisease(\AppBundle\Entity\Disease $disease)
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
     * @param \AppBundle\Entity\Symptom $symptom
     * @return Diagnosis
     */
    public function addSymptom(\AppBundle\Entity\Symptom $symptom)
    {
        $this->symptom[] = $symptom;

        return $this;
    }

    /**
     * Remove symptom
     *
     * @param \AppBundle\Entity\Symptom $symptom
     */
    public function removeSymptom(\AppBundle\Entity\Symptom $symptom)
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
