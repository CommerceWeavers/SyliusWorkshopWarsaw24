<?php

declare(strict_types=1);

namespace App\Packaging\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addPackagingsMenu(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $catalogSubmenu = $menu->getChild('catalog');

        $catalogSubmenu
            ->addChild('packagings', ['route' => 'app_admin_packaging_index'])
            ->setLabel('app.ui.packagings')
            ->setLabelAttribute('icon', 'box')
        ;
    }
}
