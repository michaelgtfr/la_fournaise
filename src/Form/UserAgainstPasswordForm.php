<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 08/11/2021
 * Time: 16:22
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserAgainstPasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("email", EmailType::class, [
                'label' => 'email'
            ])
            ->add("name", TextType::class, [
                'label' => 'nom'
            ])
            ->add("nameOrderWithdrawal", TextType::class, [
                'label' => 'surnom pour la commande'
            ])
            ->add("numberCellphone", NumberType::class, [
                'label' => "numéro de téléphone"
            ])
            ;
    }
}