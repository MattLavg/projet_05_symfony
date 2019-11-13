<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Developer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('content')

            ->add('developers', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => Developer::class,
                    'choice_value' => 'id',
                    'choice_label' => 'name',
                    'label' => false
                ] 
            ]);

        // $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
        //     $game = $event->getData();
        //     $form = $event->getForm();
    
        //     // checks if the Product object is "new"
        //     // If no data is passed to the form, the data is "null".
        //     // This should be considered a new "Product"
        //     if (!$game || null === $game->getId()) {
        //         $form->add('name');
        //     } else {
        //         $form->remove('name');
        //     }
        // });
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
