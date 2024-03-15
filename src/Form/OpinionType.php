<?php

namespace App\Form;

use App\Entity\Opinion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OpinionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank(),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]*$/',
                        'message' => 'Le champ ne doit contenir que des lettres.',
                    ]),
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Message',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9\s\-_.,!?]*$/',
                        'message' => 'Le champ ne doit contenir que des lettres, chiffres, espaces et les caractères spéciaux - _ . , ! ?',
                    ]),
                ]
            ])
            ->add('mark',  RangeType::class, [
                'attr' => [
                    'class' => 'form-range',
                    'min' => 1,
                    'max' => 5,
                ],
                'label' => 'Note de 1 (extrême gauche) à 5 (extrême droite)',
                'label_attr' => [
                    'class' => 'form-check-label mt-4',
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(6),
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4 mb-4',
                    'style' => 'width:100%',
                ],
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Opinion::class,
        ]);
    }
}
