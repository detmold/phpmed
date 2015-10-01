<?php
// src/Medhelp/MedhelpBundle/Entity/Patient.php

namespace Medhelp\MedhelpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="integer")
     */
     private $mobile;

     /**
	 * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^((\d{3}[- ]\d{3}[- ]\d{2}[- ]\d{2})|(\d{3}[- ]\d{2}[- ]\d{2}[- ]\d{3}))$/",
     *     match=false,
     *     message="Accepted formats: 222-22-22-222 | 222-222-22-22 | 222 22 22 222 | 222 222 22 22 Non accepted formats: 2222222222 | XXXXXXXXXX"
     * )
     */
     private $pesel;

     /**
     * @ORM\Column(type="string", length=255)
     */
     private $adress;
	 
	 /**
     * @ORM\Column(type="string", length=3)
     */
     private $nfz;
	 
	 /**
     * @ORM\Column(name="gender", type="string", columnDefinition="enum('m', 'f')")
     */
     private $sex = 'm';
	 
	 /**
     * @ORM\Column(type="date", nullable=true)
     */
     private $birthday;
	 
	 /**
     * @ORM\Column(type="date", nullable=true)
     */
     private $registerdate;
	 
	 /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
     private $person;
	 
	 /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
     private $nip;

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
     * @param \Medhelp\MedhelpBundle\Entity\Diagnosis $diagnoses
     * @return Patient
     */
    public function addDiagnosis(\Medhelp\MedhelpBundle\Entity\Diagnosis $diagnoses)
    {
        $this->diagnoses[] = $diagnoses;

        return $this;
    }

    /**
     * Remove diagnoses
     *
     * @param \Medhelp\MedhelpBundle\Entity\Diagnosis $diagnoses
     */
    public function removeDiagnosis(\Medhelp\MedhelpBundle\Entity\Diagnosis $diagnoses)
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

	public function __toString() {
		return $this->lastName . " " . $this->firstName;
	}

    /**
     * Set mobile
     *
     * @param integer $mobile
     * @return Patient
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return integer 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set pesel
     *
     * @param string $pesel
     * @return Patient
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get pesel
     *
     * @return string 
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return Patient
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string 
     */
    public function getAdress()
    {
        return $this->adress;
    }
	
	/**
     * Set nfz
     *
     * @param string $nfz
     * @return Patient
     */
    public function setNfz($nfz)
    {
        $this->nfz = $nfz;

        return $this;
    }

    /**
     * Get nfz
     *
     * @return string 
     */
    public function getNfz()
    {
        return $this->nfz;
    }
	
	/**
     * Set sex
     *
     * @param string $sex
     * @return Patient
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }
	
	/**
	 * Set birthday
	 *
	 * @param date $birthday
	 */
	public function setBirthday($birthday)
	{
		$this->birthday = $birthday;
	}

	/**
	 * Get birthday
	 *
	 * @return date 
	 */
	public function getBirthday()
	{
		return $this->birthday;
	}
	
	/**
	 * Set registerdate
	 *
	 * @param date $registerdate
	 */
	public function setRegisterdate($registerdate)
	{
		$this->registerdate = $registerdate;
	}

	/**
	 * Get registerdate
	 *
	 * @return date 
	 */
	public function getRegisterdate()
	{
		return $this->registerdate;
	}
	
	/**
     * Set person
     *
     * @param string $person
     * @return Patient
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return string 
     */
    public function getPerson()
    {
        return $this->person;
    }
	
	/**
     * Set nip
     *
     * @param string $nip
     * @return Patient
     */
    public function setNip($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get nip
     *
     * @return string 
     */
    public function getNip()
    {
        return $this->nip;
    }

}
