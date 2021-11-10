<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 08/11/2021
 * Time: 14:45
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ApplicationInformationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("emailApplication", TextType::class, [
                'label' => 'email de l\'application'
            ])
            ->add("facebookApplication", TextType::class, [
                'label' => 'lien facebook'
            ])
            ->add('phoneNumberApplication', NumberType::class, [
                'label' => 'numéro de téléphone'
            ])
        ;
    }
}