<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Customer;
use App\Entity\Orders;
use App\Entity\OrderStateLang;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('totalPaid')
            ->add('dateAdd')
            ->add('idCustomer', EntityType::class, [
                'class' => Customer::class,
            ])
            ->add('idAddressDelivery', EntityType::class, [
                'class' => Address::class,
            ])
            ->add('currentState', EntityType::class, [
                'class' => OrderStateLang::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
