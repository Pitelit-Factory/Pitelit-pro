<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plaque', TextType::class, [
                'attr' => [
                    'placeholder' => 'AA-123-AA',
                    'label' => 'immatriculation',
                    'pattern' => '[A-Z]{2}-[0-9]{3}-[A-Z]{2}'

                ]
            ])
            ->add('marque')
            ->add('modele')
            ->add('carburant', ChoiceType::class, [
                'choices' => [
                    '' => '',
                    'SP98' => 'SP98',
                    'SP95' => 'SP95',
                    'Diesel' => 'Diesel',
                    'Electrique' => 'Electrique'

                ]
            ])
            ->add('finition');
            // ->add('annee', DateType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
