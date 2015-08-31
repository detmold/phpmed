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
        $symptoms = explode(';', $_GET["symptoms"]);

        echo "<pre>";
        // print_r($symptoms);

        //$disease = $this->getDoctrine()->getRepository('MedhelpMedhelpBundle:Disease')->find('1');

        //print_r($disease->getSymptom()->toArray()[0]->getName());

        // $repository = $this->getDoctrine()->getRepository('MedhelpMedhelpBundle:Disease');
        // $query = $repository->createQueryBuilder('d')
        //     ->select(array('d.name', 's.name'))
        //     ->from('Medhelp\MedhelpBundle\Entity\Symptom', 's')
        //     //->leftJoin('d.name', 's')
        //     ->getQuery();
        // $result = $query->getResult();

        // $em = $this->getDoctrine()->getManager();
        // $query = $em->createQuery('SELECT disease.name, symptom.name FROM Medhelp\MedhelpBundle\Entity\Disease disease, Medhelp\MedhelpBundle\Entity\Symptom symptom');
        // $result = $query->getResult();

        // $query = $this->getDoctrine()->getEntityManager()->createQueryBuilder();
        // $query->select('u')->from('Medhelp\MedhelpBundle\Entity\Disease', 'a');
            // ->select('d.name', 's.name')
            // ->from('Medhelp\MedhelpBundle\Entity\Disease', 'Medhelp\MedhelpBundle\Entity\Symptom');

        // $result = $query->getQuery()->getResult();
        // print_r($result);

        // if (!$disease) {
        //     throw $this->createNotFoundException(
        //         'No disease found.'
        //     );
        // }

        $result = array();

        return $this->render('MedhelpMedhelpBundle:Diagnose:result.html.twig', array(
            'diseases' => $result,
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
