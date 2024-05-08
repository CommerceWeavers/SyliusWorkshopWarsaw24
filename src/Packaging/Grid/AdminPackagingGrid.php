<?php

declare(strict_types=1);

namespace App\Packaging\Grid;

use App\Packaging\Entity\Packaging;
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

final class AdminPackagingGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_admin_packaging';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(StringField::create('code')->setLabel('Code'))
            ->addField(StringField::create('name')->setLabel('Name'))
            ->addField(TwigField::create('price', 'Admin/Packaging/_price.html.twig')->setLabel('Price'))
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
        return Packaging::class;
    }
}
