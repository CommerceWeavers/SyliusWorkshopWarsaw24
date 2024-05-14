<?php

declare(strict_types=1);

namespace App\GiftCard\Remover;

use App\Entity\Order\Order;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Resource\Doctrine\Persistence\RepositoryInterface;

final class AfterCheckoutGiftCardsRemover
{
    public function __construct(
        private readonly RepositoryInterface $giftCardRepository,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function removeGiftCardsFromCart(Order $order): void
    {
        if ($order->getGiftCardCode() === null) {
            return;
        }

        $giftCard = $this->giftCardRepository->findOneBy(['code' => $order->getGiftCardCode()]);
        $this->entityManager->remove($giftCard);
    }
}
