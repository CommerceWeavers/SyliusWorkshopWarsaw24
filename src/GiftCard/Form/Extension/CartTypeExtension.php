<?php

declare(strict_types=1);

namespace App\GiftCard\Form\Extension;

use Sylius\Bundle\OrderBundle\Form\Type\CartType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CartTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('giftCardCode', TextType::class, [
            'label' => 'Gift card',
            'required' => false,
            'attr' => [
                'placeholder' => 'Gift card code',
            ],
        ]);
    }

    public static function getExtendedTypes(): iterable
    {
        yield CartType::class;
    }
}
