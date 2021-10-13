<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('filter', ChoiceType::class, array(
            'required' => true,
            'placeholder' => 'Select a filter',
            'choices' => [
                'Country' => 'Country',
                'State' => "State"
            ]
        ));
        $builder->add('value');
    }
}