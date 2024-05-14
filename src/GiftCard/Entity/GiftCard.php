<?php

declare(strict_types=1);

namespace App\GiftCard\Entity;

use App\GiftCard\Form\Type\GiftCardAdminType;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Update;
use Sylius\Resource\Model\ResourceInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_gift_card')]
#[AsResource(section: 'admin', templatesDir: '@SyliusAdmin/Crud')]
#[Index(routePrefix: '/admin', grid: 'app_admin_gift_card')]
#[Create(routePrefix: '/admin', formType: GiftCardAdminType::class)]
#[Update(routePrefix: '/admin', formType: GiftCardAdminType::class)]
#[Delete(routePrefix: '/admin')]
class GiftCard implements ResourceInterface
{
    public const STATE_ACTIVE = 'active';
    public const STATE_INACTIVE = 'inactive';

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private ?string $code;

    #[ORM\Column(type: 'integer')]
    private ?int $amount;

    #[ORM\Column(type: 'string', options: ['default' => self::STATE_ACTIVE])]
    private ?string $state = self::STATE_ACTIVE;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): void
    {
        $this->amount = $amount;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }
}
