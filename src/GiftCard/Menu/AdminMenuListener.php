<?php

declare(strict_types=1);

namespace App\GiftCard\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addGiftCardMenu(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $salesSubmenu = $menu->getChild('sales');

        $salesSubmenu
            ->addChild('gift_cards', ['route' => 'app_admin_gift_card_index'])
            ->setLabel('app.ui.gift_cards')
            ->setLabelAttribute('icon', 'gift')
        ;
    }
}
