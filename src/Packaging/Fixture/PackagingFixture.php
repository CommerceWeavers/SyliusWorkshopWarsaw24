<?php

declare(strict_types=1);

namespace App\Packaging\Fixture;

use App\Packaging\Entity\Packaging;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class PackagingFixture extends AbstractFixture
{
    private Generator $faker;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->faker = Factory::create();
    }

    public function load(array $options): void
    {
        for ($i = 0; $i < $options['amount']; ++$i) {
            $packaging = new Packaging();
            $packaging->setCode('PACKAGING_' . $i);
            $packaging->setName($this->faker->word);
            $packaging->setPrice($this->faker->numberBetween(100, 1000));

            $this->entityManager->persist($packaging);
        }

        $this->entityManager->flush();
    }

    public function getName(): string
    {
        return 'packaging';
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
