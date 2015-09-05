<?php
// src/Medhelp/MedhelpBundle/Entity/Disease.php

namespace Medhelp\MedhelpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Disease {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255);
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255);
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="Symptom", inversedBy="disease")
     * @ORM\JoinTable(name="Disease_Symptom",
     *      joinColumns={@ORM\JoinColumn(name="disease_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="symptom_id", referencedColumnName="id")}
     *      )
     */
    private $symptom;

    /**
     * @ORM\ManyToMany(targetEntity="Diagnosis", mappedBy="disease")
     */
    private $diagnosis;
	
	/**
     * @ORM\Column(type="integer");
     */
    private $accuracy;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->symptom = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diagnosis = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Disease
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Disease
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Disease
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add symptom
     *
     * @param \Medhelp\MedhelpBundle\Entity\Symptom $symptom
     * @return Disease
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

    /**
     * Add diagnosis
     *
     * @param \Medhelp\MedhelpBundle\Entity\Diagnosis $diagnosis
     * @return Disease
     */
    public function addDiagnosi(\Medhelp\MedhelpBundle\Entity\Diagnosis $diagnosis)
    {
        $this->diagnosis[] = $diagnosis;

        return $this;
    }

    /**
     * Remove diagnosis
     *
     * @param \Medhelp\MedhelpBundle\Entity\Diagnosis $diagnosis
     */
    public function removeDiagnosi(\Medhelp\MedhelpBundle\Entity\Diagnosis $diagnosis)
    {
        $this->diagnosis->removeElement($diagnosis);
    }

    /**
     * Get diagnosis
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosis()
    {
        return $this->diagnosis;
    }
	
	/**
     * Get id
     *
     * @return integer 
     */
    public function getAccuracy()
    {
        return $this->accuracy;
    }

    /**
     * Set accuracy
     *
     * @param integer $accuracy
     * @return Disease
     */
    public function setAccuracy($accuracy)
    {
        $this->accuracy = $accuracy;

        return $this;
    }
}
