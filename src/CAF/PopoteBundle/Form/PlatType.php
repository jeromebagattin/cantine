<?php

namespace CAF\PopoteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CAF\PopoteBundle\Repository\TypePlatRepository;

class PlatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle')
                ->add('porc')
                ->add('typeplat', 'entity', array(
                        'class' => 'CAFPopoteBundle:TypePlat',
                        'property' => 'libelle',
                        'multiple' => false,
                        'query_builder' => function(TypePlatRepository $repo) {
                            return $repo->allTypePlat();
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
            'data_class' => 'CAF\PopoteBundle\Entity\Plat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'caf_popotebundle_plat';
    }


}
