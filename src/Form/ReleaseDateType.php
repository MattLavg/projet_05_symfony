<?php

namespace App\Form;

use App\Entity\ReleaseDate;
use App\Entity\Platform;
use App\Entity\Region;
use App\Entity\Publisher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ReleaseDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder    
            // ->add('game')
            ->add('platform', EntityType::class, [
                'class' => Platform::class,
                'choice_value' => 'id',
                'choice_label' => 'name',
                'label' => false
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'choice_value' => 'id',
                'choice_label' => 'name',
                'label' => false
            ])
            ->add('publisher', EntityType::class, [
                'class' => Publisher::class,
                'choice_value' => 'id',
                'choice_label' => 'name',
                'label' => false
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReleaseDate::class,
        ]);
    }
}
