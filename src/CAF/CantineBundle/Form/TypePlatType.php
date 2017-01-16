<?php

namespace CAF\CantineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CAF\CantineBundle\Repository\PlatsRepository;

class TypePlatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle', 'text')
                ->add('plats', 'entity', array(
                    'class' => 'CAFCantineBundle:Plats',
                    'property' => 'libelle',
                    'multiple' => true,
                    'query_builder' => function(PlatsRepository $repo) {
                        return $repo->mFindAll();
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
            'data_class' => 'CAF\CantineBundle\Entity\TypePlat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'caf_cantinebundle_typeplat';
    }


}
