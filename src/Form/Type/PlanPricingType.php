<?php
// src/Form/Type/TaskType.php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class PlanPricingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class)
        ->add('price', IntegerType::class)
        ->add('ram', IntegerType::class)
        ->add('storage', IntegerType::class)
        ->add('backup', CheckboxType::class, [ 'required' => false ])
        ->add('save', SubmitType::class)
        ;
    }
}