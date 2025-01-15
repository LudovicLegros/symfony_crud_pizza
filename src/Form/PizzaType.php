<?php

namespace App\Form;

use App\Entity\Pate;
use App\Entity\Pizza;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('secretIngredient')
            ->add('ingredient', EntityType::class, [ //Champ pour ManyToMany
                    'class' => Ingredient::class, //Connexion du champ avec l'entité concerné
                    'choice_label' => 'label',
                    'multiple' => true, //Création de checkbox
                    'expanded' => true,
            ])
            ->add('pate', EntityType::class, [
                'class' => Pate::class,
                'choice_label' => 'label',
            ])
            ->add('imageFile', FileType::class,[ //Champ de fichier
                'constraints' => [
                    new File([
                        'maxSize' => '2M', //Ajout de contrainte (Optionnel)
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier au format JPEG, JPG, PNG ou WEBP.'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
