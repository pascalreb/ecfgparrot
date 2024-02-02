<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Equipement;
use App\Repository\EquipementRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
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
                    new Regex([
                        'pattern' => '/^[a-zA-Z]*$/',
                        'message' => 'Le champ ne doit contenir que des lettres.',
                    ]),
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
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9\s]*$/',
                        'message' => 'Le champ ne doit contenir que des lettres, chiffres et espaces.',
                    ]),
                ]
            ])
            ->add('year', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Année',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Regex([
                        'pattern' => '/^\d{4}$/',
                        'message' => 'Le format n\'est pas valide, l\'année doit contenir quatre chiffres.',
                    ]), 
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
                    new Regex([
                        'pattern' => '/^[a-zA-Z]*$/',
                        'message' => 'Le champ ne doit contenir que des lettres.',
                    ]),
                ]
            ])
            ->add('kilometers', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    // 'minlength' => '3',
                    // 'maxlength' => '6',
                ],
                'label' => 'Kilométrage',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\Positive(),
                    // new Assert\Length(['min' => 3, 'max' => 6]),
                    new Regex([
                        'pattern' => '/^\d{3,6}$/',
                        'message' => 'Le champ doit contenir entre trois et six chiffres.',
                    ]), 
                ]
            ])
            ->add('price', MoneyType::class, [
                'attr' => [
                    'class' => 'form-control mb-4',
                ],
                'label' => 'Prix en ',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Regex([
                        'pattern' => '/^\d{4,6}$/',
                        'message' => 'Le champ doit contenir entre quatre et six chiffres.',
                    ]),                 
                ]
            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipement::class,
                'query_builder' => function (EquipementRepository $repository) {
                    return $repository->createQueryBuilder('equipement')
                        ->orderBy('equipement.name', 'ASC');
                },
                'label' => 'Les équipements',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('images', FileType::class, [
                'attr' => [
                    'class' => 'form-control mt-4',
                ],
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'label_attr' => [
                    'class' => 'form-label',
                ],
                // 'constraints' => [
                //     new Assert\File([
                //         'maxSize' => '5M', // Taille maximale du fichier
                //         'mimeTypes' => [
                //             'image/jpeg',
                //             'image/png',
                //             'image/jpg',
                //         ], // Types MIME autorisés
                //         'mimeTypesMessage' => 'Veuillez télécharger un format d\'image valide (JPEG ou PNG).',
                //     ]),               
                // ],

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
