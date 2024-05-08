<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductTranslationInterface;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product')]
class Product extends BaseProduct
{
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $packable = false;

    public function isPackable(): bool
    {
        return $this->packable;
    }

    public function setPackable(bool $packable): void
    {
        $this->packable = $packable;
    }

    protected function createTranslation(): ProductTranslationInterface
    {
        return new ProductTranslation();
    }
}
