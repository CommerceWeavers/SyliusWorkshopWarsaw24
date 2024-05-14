<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514091611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_order_item ADD packaging_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_order_item ADD CONSTRAINT FK_77B587ED4E7B3801 FOREIGN KEY (packaging_id) REFERENCES app_packaging (id)');
        $this->addSql('CREATE INDEX IDX_77B587ED4E7B3801 ON sylius_order_item (packaging_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_order_item DROP FOREIGN KEY FK_77B587ED4E7B3801');
        $this->addSql('DROP INDEX IDX_77B587ED4E7B3801 ON sylius_order_item');
        $this->addSql('ALTER TABLE sylius_order_item DROP packaging_id');
    }
}
