<?php

declare(strict_types=1);

namespace App\Entity\Order;

use App\GiftCard\OrderProcessor\GiftCardOrderProcessor;
use App\Packaging\OrderProcessor\PackagingOrderProcessor;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Order as BaseOrder;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_order')]
class Order extends BaseOrder
{
    #[ORM\Column(type: 'string', name: 'gift_card_code', nullable: true)]
    private ?string $giftCardCode = null;

    public function getPackagingTotal(): int
    {
        return $this->getAdjustmentsTotalRecursively(PackagingOrderProcessor::PACKAGING_ADJUSTMENT_TYPE);
    }

    public function getGiftCardTotal(): int
    {
        return $this->getAdjustmentsTotalRecursively(GiftCardOrderProcessor::GIFT_CARD_ADJUSTMENT);
    }

    public function getGiftCardCode(): ?string
    {
        return $this->giftCardCode;
    }

    public function setGiftCardCode(?string $giftCardCode): void
    {
        $this->giftCardCode = $giftCardCode;
    }
}
