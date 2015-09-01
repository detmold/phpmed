<?php

namespace Medhelp\MedhelpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PatientController extends Controller
{
    /**
     * @Route("/patients")
     */
    public function listAction()
    {
        $patients = $this->getDoctrine()->getRepository('MedhelpMedhelpBundle:Patient')->findAll();

        return $this->render('MedhelpMedhelpBundle:Patient:patients_list.html.twig', array(
            'patients' => $patients
        ));
    }
}
