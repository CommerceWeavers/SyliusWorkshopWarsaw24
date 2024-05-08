<?php

declare(strict_types=1);

namespace App\Packaging\Form\Type;

use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class AdminPackagingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class)
            ->add('name', TextType::class)
            ->add('price', MoneyType::class, [
                'currency' => 'USD',
            ])
        ;
    }
}
