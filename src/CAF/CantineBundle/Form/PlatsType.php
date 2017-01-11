<?php

namespace CAF\CantineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CAF\CantineBundle\Repository\TypePlatRepository;

class PlatsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle', 'text')
//                ->add('typeplat', new TypePlatType())
                ->add('typeplat', 'entity', array(
                        'class' => 'CAFCantineBundle:TypePlat',
                        'property' => 'libelle',
                        'multiple' => false,
                        'query_builder' => function(TypePlatRepository $repo) {
                            return $repo->tousTypesPlats();
                        }
                    ))
//                ->add('typePlat', 'collection', array(
//                    'type' => new TypePlatType(),
//                    'allow_add' => true,
//                    'allow_delete' => true
//                ))
                ->add('porc', 'checkbox', array('required' => false))
                ->add('ok', 'submit')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CAF\CantineBundle\Entity\Plats'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'caf_cantinebundle_plats';
    }


}
