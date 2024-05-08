<?php

declare(strict_types=1);

namespace App\GiftCard\Grid;

use App\GiftCard\Entity\GiftCard;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class AdminGiftCardGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_admin_gift_card';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(StringField::create('code')->setLabel('Code'))
            ->addField(TwigField::create('amount', 'Admin/GiftCard/_amount.html.twig')->setLabel('Amount'))
            ->addActionGroup(MainActionGroup::create(
                CreateAction::create(),
            ))
            ->addActionGroup(ItemActionGroup::create()
                ->addAction(UpdateAction::create())
                ->addAction(DeleteAction::create())
            );
        ;
    }

    public function getResourceClass(): string
    {
        return GiftCard::class;
    }
}
