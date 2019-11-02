<?php

namespace App\Form;

use App\Entity\DeparturePublication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeparturePublicationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departureCity', null, [
                'label' => 'Ville de départ'
            ])
            ->add('arrivalCity', null, [
                'label' => "Ville d'arrivée"
            ])
            ->add('departureDatetime', null, [
                'label' => 'Date et heure de départ'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DeparturePublication::class,
        ]);
    }
}
