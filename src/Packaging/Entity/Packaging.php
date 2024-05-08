<?php

declare(strict_types=1);

namespace App\Packaging\Entity;

use App\Packaging\Form\Type\AdminPackagingType;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Model\ResourceInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_packaging')]
#[AsResource(section: 'admin', templatesDir: '@SyliusAdmin/Crud')]
#[Index(routePrefix: '/admin', grid: 'app_admin_packaging')]
#[Create(routePrefix: '/admin', formType: AdminPackagingType::class)]
class Packaging implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $code;

    #[ORM\Column(type: 'integer')]
    private int $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}
