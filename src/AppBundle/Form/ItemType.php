<?php

namespace AppBundle\Form;

use AppBundle\Entity\Item;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\SpotRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('categories', EntityType::class, array(
                    'label' => 'Liste des categories',
                    'class'        => 'AppBundle\Entity\Category',
                    'choice_label' => 'name',
                    'multiple'     => true,
                )
            )
            ->add('spot', EntityType::class, array(
                    'label' => 'Liste des spots',
                    'class'        => 'AppBundle\Entity\Spot',
                    'query_builder' => function (SpotRepository $er) use ($options) {
                        return $er->getSpots($options['id_user']);
                    },
                    'choice_label' => 'title',
                )
            );

        if ($options['item_type'] == 'image') {
            $builder->add('url', FileType::class, array('label' => 'Picture(s) to upload', 'multiple' => true));
        } else if ($options['item_type'] == 'video') {
            $builder->add('url');
        } else {
            $builder->add('url');
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Item',
            'id_user'         => '',
            'item_type'       => 'edit'
        ));
    }
}