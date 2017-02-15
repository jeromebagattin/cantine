<?php

namespace CAF\PopoteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CAF\PopoteBundle\Repository\PlatRepository;
use CAF\PopoteBundle\Repository\MenuPlatRepository;

class MenuType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('dateMenu', 'date')
                ->add('dateValidation', 'date')
                ->add('plats', 'entity', array(
                    'class' => 'CAFPopoteBundle:Plat',
                    'label' => 'Plats du menu : ',
                    'property' => 'libelle',
                    'multiple' => true,
                    'expanded' => false,
                    'query_builder' => function(PlatRepository $repo) {
                        return $repo->mFindAll();
                    }
                ))
                
                ->add('ok', 'submit')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CAF\PopoteBundle\Entity\Menu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'caf_popotebundle_menu';
    }

}
