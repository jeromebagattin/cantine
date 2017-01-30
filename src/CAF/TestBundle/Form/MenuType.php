<?php

namespace CAF\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CAF\TestBundle\Repository\PlatRepository;

class MenuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateMenu')        
                ->add('plats', 'entity', array(
                    'class'    => 'CAFTestBundle:Plat',
                    'label'    => 'Plats du menu : ',
                    'property' => 'libelle',
                    'multiple' => true,
                    'expanded' => true,
                    'query_builder' => function(PlatRepository $repo) {
                        return $repo->myFindAll();
                    }
                ))
                ->add('ok', 'submit')
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CAF\TestBundle\Entity\Menu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'caf_testbundle_menu';
    }


}
