<?php

namespace CAF\PopoteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CAF\PopoteBundle\Repository\PlatRepository;

class RepaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       // $idMenu = $options['data']->getId();
        
        $builder->add('prixRepa', 'money')
//                ->add('menu', 'entity', array(
//                    'class'    => 'CAFPopoteBundle:Menu',
//                    'label'    => 'Menu : ',
//                    'property' => 'id',
//                    'multiple' => false,
                   
//                    'query_builder' => function(PlatRepository $repo) {
//                        return $repo->mFindAll();
//                    }
//                ))
//                ->add('plats', 'entity', array(
//                    'class'    => 'CAFPopoteBundle:Plat',
//                    'label'    => 'Plats du repa : ',
//                    'property' => 'libelle',
//                    'multiple' => true,
//                    'expanded' => true,
//                    'query_builder' => function(PlatRepository $repo) {
//                        return $repo->findByMenu(1);
//                    }
//                ))
                ->add('ok', 'submit')
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CAF\PopoteBundle\Entity\Repa'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'caf_popotebundle_repa';
    }


}
