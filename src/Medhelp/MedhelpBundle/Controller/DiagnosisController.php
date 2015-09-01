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
        foreach ($symptomsSearched as $symptomSearched) {
            $symptom = $this->getDoctrine()->getRepository('MedhelpMedhelpBundle:Symptom')->findOneByName($symptomSearched);

            $symptomDiseases = array();
            foreach ($symptom->getDisease() as $disease) {
                $symptomDiseases[$disease->getName()] = $disease;
            }

            $diseases = array_merge($diseases, $symptomDiseases);
        }

        return $this->render('MedhelpMedhelpBundle:Diagnose:result.html.twig', array(
            'diseases' => $diseases
        ));
    }
}
