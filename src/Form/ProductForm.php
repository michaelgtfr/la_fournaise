<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/11/2021
 * Time: 15:44
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class ProductForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('presentation', TextType::class, [
                'label' => 'Présentation',
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix',
            ])
            ->add('status', NumberType::class, [
                'label' => 'Status',
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du menu/ produit'
            ])
            ->add('ingredientList', TextType::class, [
                'label' => 'Liste des ingredients'
            ])
            ->add('typeOfProduct', ChoiceType::class, [
                'label' => 'Sous-menu du menu/ produit',
                'choices' => [
                    '1' => 1,
                    'Apéro' => 2,
                    'Plat' => 3,
                    '4' => 4,
                    '5' => 5,
                    'Sandwitch' => 6,
                    'Boisson' => 7
                ]
            ])
            ->add('uploadFile', FileType::class, [
                'label' => 'Photo du menu/ produit',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'attention!! les images autorisés sont le png, jpg ou jpeg',
                    ])
                ]
            ])
            ;

    }
}