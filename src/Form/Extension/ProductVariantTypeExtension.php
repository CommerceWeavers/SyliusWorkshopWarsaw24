<?php

declare(strict_types=1);

namespace App\Form\Extension;

use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductVariantType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductVariantTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('generatedGiftCardValue', MoneyType::class, [
                'currency' => 'USD',
            ])
        ;
    }

    public static function getExtendedTypes(): iterable
    {
        yield ProductVariantType::class;
    }
}
