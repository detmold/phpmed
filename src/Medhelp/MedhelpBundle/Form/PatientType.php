<?php

namespace Medhelp\MedhelpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('mobile')
            ->add('pesel')
            ->add('adress')
			->add('nfz')
			->add('sex', 'choice', array(
					'choices'  => array('m' => 'male', 'f' => 'female'),
					'required' => false,
				))
			->add('birthday', 'date', array(
				'widget' => 'choice',
				// this is actually the default format for single_text
				'years' => range(date('Y'), date('Y') - 100),
			))
			->add('registerdate', 'date', array(
				'widget' => 'choice',
				// this is actually the default format for single_text
				'years' => range(date('Y'), date('Y') - 20),
			))
			->add('person', null, array('label' => 'Person to inform', 'required' => false))
			->add('nip', null, array('required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Medhelp\MedhelpBundle\Entity\Patient'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'medhelp_medhelpbundle_patient';
    }
}
