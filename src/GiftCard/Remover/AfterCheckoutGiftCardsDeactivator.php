<?php

declare(strict_types=1);

namespace App\GiftCard\Remover;

use App\Entity\Order\Order;
use SM\Factory\FactoryInterface;
use Sylius\Resource\Doctrine\Persistence\RepositoryInterface;

final class AfterCheckoutGiftCardsDeactivator
{
    public function __construct(
        private readonly RepositoryInterface $giftCardRepository,
        private readonly FactoryInterface $stateMachineFactory,
    ) {
    }

    public function deactivateGiftCardFromCart(Order $order): void
    {
        if ($order->getGiftCardCode() === null) {
            return;
        }

        $giftCard = $this->giftCardRepository->findOneBy(['code' => $order->getGiftCardCode()]);

        $stateMachine = $this->stateMachineFactory->get($giftCard);
        $stateMachine->apply('deactivate');
    }
}
