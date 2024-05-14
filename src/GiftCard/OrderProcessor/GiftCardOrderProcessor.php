<?php

declare(strict_types=1);

namespace App\GiftCard\OrderProcessor;

use App\Entity\Order\Order;
use App\GiftCard\Entity\GiftCard;
use Sylius\Component\Order\Factory\AdjustmentFactoryInterface;
use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;
use Sylius\Resource\Doctrine\Persistence\RepositoryInterface;

final class GiftCardOrderProcessor implements OrderProcessorInterface
{
    public const GIFT_CARD_ADJUSTMENT = 'gift_card';

    public function __construct(
        private readonly RepositoryInterface $giftCardRepository,
        private readonly AdjustmentFactoryInterface $adjustmentFactory
    ) {
    }

    /** @param Order $order */
    public function process(OrderInterface $order): void
    {
        $order->removeAdjustments(self::GIFT_CARD_ADJUSTMENT);
        $giftCardCode = $order->getGiftCardCode();

        if ($giftCardCode === null) {
            return;
        }

        /** @var GiftCard|null $giftCard */
        $giftCard = $this->giftCardRepository->findOneBy(['code' => $giftCardCode]);
        if ($giftCard === null) {
            return;
        }

        $giftCardAdjustment = $this->adjustmentFactory->createWithData(
            self::GIFT_CARD_ADJUSTMENT,
            'Gift card',
            min($giftCard->getAmount(), $order->getTotal()) * -1,
        );
        $order->addAdjustment($giftCardAdjustment);
    }
}
