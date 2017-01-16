<?php

namespace CAF\CantineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CAF\CantineBundle\Repository\PlatsRepository;

class MenusType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateMenu', 'date')
                ->add('dateValidation', 'date')
                ->add('plats', 'entity', array(
                    'class' => 'CAFCantineBundle:Plats',
                    'label'         => 'Plats',
                    'property' => 'libelle',
                    'mapped' => false,
                    'multiple' => true,
                    'expanded'      => true,
                    'query_builder' => function(PlatsRepository $repo) {
                        return $repo->mFindAll();
                    }
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CAF\CantineBundle\Entity\Menus'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'caf_cantinebundle_menus';
    }


}
