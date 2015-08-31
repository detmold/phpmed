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
        return $this->render('MedhelpMedhelpBundle:Diagnose:search.html.twig');
    }

    /**
     * @Route("/result")
     */
    public function resultAction()
    {
        $symptomsSearched = explode(' ', $_GET["symptoms"]);

        $result = array();
        foreach ($symptomsSearched as $symptomSearched) {
            $symptom = $this->getDoctrine()->getRepository('MedhelpMedhelpBundle:Symptom')->findOneByName($symptomSearched);
            foreach ($symptom->getDisease() as $disease) {
                array_push($result, $disease); // Temporary for debug
            }
        }

        return $this->render('MedhelpMedhelpBundle:Diagnose:result.html.twig', array(
            'diseases' => $result
        ));
    }
}
