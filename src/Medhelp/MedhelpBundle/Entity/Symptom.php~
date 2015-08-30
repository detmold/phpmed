<?php
// src/Medhelp/MedhelpBundle/Entity/Symptom.php

namespace Medhelp\MedhelpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Symptom {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\ManyToMany(targetEntity="Disease", mappedBy="symptom")
     */
    private $disease;

    /**
     * @ORM\ManyToMany(targetEntity="Diagnosis", mappedBy="symptom")
     */
    private $diagnosis;

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
     * @return Symptom
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
     * @return Symptom
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
     * Set description
     *
     * @param string $description
     * @return Symptom
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
     * @return Symptom
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
     * Add diagnosis
     *
     * @param \AppBundle\Entity\Diagnosis $diagnosis
     * @return Symptom
     */
    public function addDiagnosi(\AppBundle\Entity\Diagnosis $diagnosis)
    {
        $this->diagnosis[] = $diagnosis;

        return $this;
    }

    /**
     * Remove diagnosis
     *
     * @param \AppBundle\Entity\Diagnosis $diagnosis
     */
    public function removeDiagnosi(\AppBundle\Entity\Diagnosis $diagnosis)
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
}
