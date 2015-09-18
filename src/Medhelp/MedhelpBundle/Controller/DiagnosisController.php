<?php

namespace Medhelp\MedhelpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Medhelp\MedhelpBundle\Entity\Diagnosis;
use Medhelp\MedhelpBundle\Form\DiagnosisType;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Diagnosis controller.
 *
 * @Route("/diagnosis")
 */
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
		$entity = new Diagnosis();
		$entity->setDate(new \DateTime());
        $symptomsSearched = explode(';', $_GET["symptoms"]);

        $diseases = array(); 
		$patients = $this->getDoctrine()->getRepository('MedhelpMedhelpBundle:Patient')->findAll();
		//if (count($symptomsSearched) > 1) {
			$symptomDiseasesAcc = array();
			foreach ($symptomsSearched as $symptomSearched) {
				$accuracy = 0;
				$symptom = $this->getDoctrine()->getRepository('MedhelpMedhelpBundle:Symptom')->findOneByName($symptomSearched);
				$entity->addSymptom($symptom);
	
				$symptomDiseases = array();
				if (is_object($symptom)) {
					foreach ($symptom->getDisease() as $disease) {
						$entity->addDisease($disease);
						foreach ($disease->getSymptom() as $s) {
							if ($s->getName() == $symptomSearched) {
								$accuracy = $disease->getAccuracy() + 1;
							}
						}
						$disease->setAccuracy($accuracy);
						$symptomDiseases[$disease->getName()] = $disease;
					}
				}
				$diseases = array_merge($diseases, $symptomDiseases);
				uasort($diseases, function($a, $b) {
					if ($a->getAccuracy() == $b->getAccuracy()) {
						return 0;
					}
					return ($a->getAccuracy() < $b->getAccuracy()) ? 1 : -1;
				});
			}
		//}
		
        $form   = $this->createCreateForm($entity);

        return $this->render('MedhelpMedhelpBundle:Diagnose:result.html.twig', array(
            'diseases' => $diseases,
			'patients' => $patients,
			'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
	
	/**
     * @Route("/combo")
     */
    public function comboAction()
    {
        return $this->render('MedhelpMedhelpBundle:Diagnose:combo.html.twig');
    }

    /**
     * Lists all Diagnosis entities.
     *
     * @Route("/", name="diagnosis")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MedhelpMedhelpBundle:Diagnosis')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Diagnosis entity.
     *
     * @Route("/", name="diagnosis_create")
     * @Method("POST")
     * @Template("MedhelpMedhelpBundle:Diagnosis:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Diagnosis();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diagnosis_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Diagnosis entity.
     *
     * @param Diagnosis $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Diagnosis $entity)
    {
        $form = $this->createForm(new DiagnosisType(), $entity, array(
            'action' => $this->generateUrl('diagnosis_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Diagnosis entity.
     *
     * @Route("/new", name="diagnosis_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Diagnosis();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Diagnosis entity.
     *
     * @Route("/{id}", name="diagnosis_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedhelpMedhelpBundle:Diagnosis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnosis entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Diagnosis entity.
     *
     * @Route("/{id}/edit", name="diagnosis_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedhelpMedhelpBundle:Diagnosis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnosis entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Diagnosis entity.
    *
    * @param Diagnosis $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Diagnosis $entity)
    {
        $form = $this->createForm(new DiagnosisType(), $entity, array(
            'action' => $this->generateUrl('diagnosis_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Diagnosis entity.
     *
     * @Route("/{id}", name="diagnosis_update")
     * @Method("PUT")
     * @Template("MedhelpMedhelpBundle:Diagnosis:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedhelpMedhelpBundle:Diagnosis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnosis entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('diagnosis_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Diagnosis entity.
     *
     * @Route("/{id}", name="diagnosis_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MedhelpMedhelpBundle:Diagnosis')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Diagnosis entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diagnosis'));
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
