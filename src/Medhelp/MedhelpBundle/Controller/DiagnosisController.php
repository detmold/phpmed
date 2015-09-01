<?php

namespace Medhelp\MedhelpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DiagnosisController extends Controller
{
    /**
     * @Route("/diagnose")
     */
    public function searchAction()
    {
        $symptoms = $this->getDoctrine()->getRepository('MedhelpMedhelpBundle:Symptom')->findAll();

        return $this->render('MedhelpMedhelpBundle:Diagnose:search.html.twig', array(
            'symptoms' => $symptoms
        ));
    }

    /**
     * @Route("/result")
     */
    public function resultAction()
    {
        $symptomsSearched = explode(';', $_GET["symptoms"]);

        $diseases = array();
		if (count($symptomsSearched) > 1) {
			$symptomDiseasesAcc = array();
			foreach ($symptomsSearched as $symptomSearched) {
				$accuracy = 0;
				$symptom = $this->getDoctrine()->getRepository('MedhelpMedhelpBundle:Symptom')->findOneByName($symptomSearched);
	
				$symptomDiseases = array();
				foreach ($symptom->getDisease() as $disease) {
					foreach ($disease->getSymptom() as $s) {
						if ($s->getName() == $symptomSearched) {
							$accuracy = $disease->getAccuracy() + 1;
						}
					}
					$disease->setAccuracy($accuracy);
					$symptomDiseases[$disease->getName()] = $disease;
				}
				
				
				uasort($symptomDiseases, function($a, $b) {
					if ($a->getAccuracy() == $b->getAccuracy()) {
						return 0;
					}
					return ($a->getAccuracy() < $b->getAccuracy()) ? -1 : 1;
				});
				$diseases = array_merge($diseases, $symptomDiseases);
			}
		}
		
        return $this->render('MedhelpMedhelpBundle:Diagnose:result.html.twig', array(
            'diseases' => $diseases
        ));
    }
	
	/**
     * @Route("/combo")
     */
    public function comboAction()
    {
        return $this->render('MedhelpMedhelpBundle:Diagnose:combo.html.twig');
    }
}
