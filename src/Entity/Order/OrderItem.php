<?php

declare(strict_types=1);

namespace App\Entity\Order;

use App\Packaging\Entity\Packaging;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\OrderItem as BaseOrderItem;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_order_item')]
class OrderItem extends BaseOrderItem
{
    #[ORM\ManyToOne(targetEntity: Packaging::class)]
    #[ORM\JoinColumn(name: 'packaging_id', referencedColumnName: 'id')]
    private ?Packaging $packaging = null;

    public function getPackaging(): ?Packaging
    {
        return $this->packaging;
    }

    public function setPackaging(?Packaging $packaging): void
    {
        $this->packaging = $packaging;
    }
}
