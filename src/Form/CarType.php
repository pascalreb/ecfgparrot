<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Marque',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
            ->add('model', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Modèle',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
            ->add('year', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '4',
                    'maxlength' => '4',
                ],
                'label' => 'Année',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 4, 'max' => 4]),
                ]
            ])
            ->add('energy', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Energie',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
            ->add('kilometers', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '3',
                    'maxlength' => '6',
                ],
                'label' => 'Kilométrage',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\Length(['min' => 3, 'max' => 6]),
                ]
            ])
            ->add('price', MoneyType::class, [
                'attr' => [
                    'class' => 'form-control mb-4',
                    'minlength' => '4',
                    'maxlength' => '6',
                ],
                'label' => 'Prix en ',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\Length(['min' => 4, 'max' => 6]),
                ]
            ])
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],

            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4 mb-4',
                ],
                'label' => 'Créer le véhicule',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
