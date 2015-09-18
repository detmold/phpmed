<?php

namespace Medhelp\MedhelpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DiagnosisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('prescription')
            ->add('patient', 'entity', array('class' => 'MedhelpMedhelpBundle:Patient', 'required' => true))
            ->add('disease')
            ->add('symptom')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Medhelp\MedhelpBundle\Entity\Diagnosis'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'medhelp_medhelpbundle_diagnosis';
    }
}
