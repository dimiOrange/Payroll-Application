<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyID', TextType::class)
            ->add('payPeriod', TextType::class)
            ->add('additionalToBaseSalary', NumberType::class)
            ->add('grossAmount', NumberType::class)
            ->add('socialSecurityEmployee', NumberType::class)
            ->add('pit', NumberType::class)
            ->add('netSalary', NumberType::class)
            ->add('socialSecurityEmployer', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Payment'
        ));
    }
}
