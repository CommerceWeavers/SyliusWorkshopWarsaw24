<?php

declare(strict_types=1);

namespace App\Packaging\OrderProcessor;

use App\Entity\Order\OrderItem;
use App\Packaging\Entity\Packaging;
use Sylius\Component\Order\Factory\AdjustmentFactoryInterface;
use Sylius\Component\Order\Model\AdjustmentInterface;
use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;

final class PackagingOrderProcessor implements OrderProcessorInterface
{
    public const PACKAGING_ADJUSTMENT_TYPE = 'packaging';

    public function __construct(private readonly AdjustmentFactoryInterface $adjustmentFactory)
    {
    }

    public function process(OrderInterface $order): void
    {
        $order->removeAdjustmentsRecursively(self::PACKAGING_ADJUSTMENT_TYPE);

        /** @var OrderItem $item */
        foreach ($order->getItems() as $item) {
            if (null === $item->getPackaging()) {
                continue;
            }

            $item->addAdjustment($this->createPackagingAdjustment($item->getPackaging()));
        }
    }

    private function createPackagingAdjustment(Packaging $packaging): AdjustmentInterface
    {
        return $this->adjustmentFactory->createWithData(
            self::PACKAGING_ADJUSTMENT_TYPE,
            $packaging->getName(),
            $packaging->getPrice()
        );
    }
}
