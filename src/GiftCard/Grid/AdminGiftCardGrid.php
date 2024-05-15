<?php

declare(strict_types=1);

namespace App\GiftCard\Grid;

use App\GiftCard\Entity\GiftCard;
use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ApplyTransitionAction;
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
            ->addField(StringField::create('state')->setLabel('State'))
            ->addActionGroup(MainActionGroup::create(
                CreateAction::create(),
            ))
            ->addActionGroup(ItemActionGroup::create()
                ->addAction(UpdateAction::create())
                ->addAction(DeleteAction::create())
                ->addAction(ApplyTransitionAction::create(
                    GiftCard::TRANSITION_DEACTIVATE,
                    'app_admin_gift_card_deactivate',
                    ['id' => 'resource.id'],
                    ['graph' => 'default', 'class' => 'black']
                )->setLabel('Deactivate')->setIcon('ban'))
                ->addAction(ApplyTransitionAction::create(
                    GiftCard::TRANSITION_ACTIVATE,
                    'app_admin_gift_card_activate',
                    ['id' => 'resource.id'],
                    ['graph' => 'default', 'class' => 'green']
                )->setLabel('Activate')->setIcon('star'))
            );
        ;
    }

    public function getResourceClass(): string
    {
        return GiftCard::class;
    }
}
