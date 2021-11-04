<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2021
 * Time: 20:25
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'nom',
            ])
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class, [
                'label' => 'mot de passe',
            ])
            ->add('confirmationPassword', PasswordType::class, [
                'label' => 'Confirmation mot de passe',
            ])
            ->add('nameOrderWithdrawal', TextType::class, [
                'label' => 'nom utilisé pour la commande',
            ])
            ->add('numberCellphone', NumberType::class, [
                'label' => 'numéro de téléphone',
            ]);

    }
}