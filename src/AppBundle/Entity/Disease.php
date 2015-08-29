<?php

namespace AppBundle\Entity;
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
     * @ORM\JoinTable(name="Disease_Symptom")
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
     * Constructor
     */
    public function __construct()
    {
        $this->symptom = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add symptom
     *
     * @param \AppBundle\Entity\Symptom $symptom
     * @return Disease
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
}
