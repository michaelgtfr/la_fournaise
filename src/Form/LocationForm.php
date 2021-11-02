<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 02/11/2021
 * Time: 13:46
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

class LocationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('beginHour', TimeType::class, [
                'label' => 'Heure de début',
            ])
            ->add('endTime', TimeType::class, [
                'label' => 'Heure de fin',
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'Longitude',
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'Latitude',
            ])
            ;
    }
}