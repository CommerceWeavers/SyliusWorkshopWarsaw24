<?php

declare(strict_types=1);

namespace App\GiftCard\Generator;

use App\Entity\Order\Order;
use App\Entity\Order\OrderItem;
use App\Entity\Product\ProductVariant;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class GiftCardGenerator
{
    public function __construct(
        private readonly FactoryInterface $giftCardFactory,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function generateFromOrderVariants(Order $order): void
    {
        /** @var OrderItem $item */
        foreach ($order->getItems() as $item) {
            /** @var ProductVariant $variant */
            $variant = $item->getVariant();
            if ($variant->getGeneratedGiftCardValue() === null || $variant->getGeneratedGiftCardValue() === 0) {
                continue;
            }

            $giftCard = $this->giftCardFactory->createNew();
            $giftCard->setCode(UUid::uuid4()->toString());
            $giftCard->setAmount($variant->getGeneratedGiftCardValue());
            $this->entityManager->persist($giftCard);
        }
    }
}
