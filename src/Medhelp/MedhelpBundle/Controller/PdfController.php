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
	
	/**
     * @Route("/diagnose/{id}")
     */
    public function diagnoseAction($id)
    {
		$em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedhelpMedhelpBundle:Diagnosis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnosis entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
	
		
		$file = 'diagnose'.time().'.pdf';
		$fileName = '/var/www/grojmy.pl/public_html/med/web/snappy/'.$file;
		$this->get('knp_snappy.pdf')->generateFromHtml(
			$this->renderView(
				'MedhelpMedhelpBundle:Pdf:show.html.twig',
				array(
					'entity'      => $entity,
					'delete_form' => $deleteForm->createView(),
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
	
	/**
     * Creates a form to delete a Diagnosis entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diagnosis_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
