<?php

namespace Medhelp\MedhelpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Pdf controller.
 *
 * @Route("/pdf")
 */
class PdfController extends Controller
{
	/**
     * @Route("/diagnosis")
     */
    public function diagnosisAction()
    {
		$em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MedhelpMedhelpBundle:Diagnosis')->findAll();
	
		
		$file = 'diagnosis'.time().'.pdf';
		$fileName = '/var/www/grojmy.pl/public_html/med/web/snappy/'.$file;
		$this->get('knp_snappy.pdf')->generateFromHtml(
			$this->renderView(
				'MedhelpMedhelpBundle:Pdf:index.html.twig',
				array(
					'entities'  => $entities
				)
			),
			$fileName
		);
		
		$content = file_get_contents($fileName);
		
		$response = new Response();
		$response->headers->set('Content-Type', 'application/pdf');
		$response->headers->set('Content-Disposition', 'inline; filename='.$file);
		$response->sendHeaders();
		$response->setContent($content);
		return $response;

    }
}
