<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623144906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant ADD quartier_id INT NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FDF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (id)');
        $this->addSql('CREATE INDEX IDX_EB95123FDF1E57AB ON restaurant (quartier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FDF1E57AB');
        $this->addSql('DROP INDEX IDX_EB95123FDF1E57AB ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP quartier_id');
    }
}
