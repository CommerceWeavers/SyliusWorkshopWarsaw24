<?php

declare(strict_types=1);

namespace App\GiftCard\Fixture;

use App\GiftCard\Entity\GiftCard;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class GiftCardFixture extends AbstractFixture
{
    private Generator $faker;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->faker = Factory::create();
    }

    public function load(array $options): void
    {
        for ($i = 0; $i < $options['amount']; ++$i) {
            $giftCard = new GiftCard();
            $giftCard->setCode($this->faker->uuid);
            $giftCard->setAmount($this->faker->randomElement([100, 200, 500, 1000, 10000]));

            $this->entityManager->persist($giftCard);
        }

        $this->entityManager->flush();
    }

    public function getName(): string
    {
        return 'gift_card';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->integerNode('amount')->isRequired()->min(0)->end()
            ->end()
        ;
    }
}
