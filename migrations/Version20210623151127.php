<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623151127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE probleme ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE probleme ADD CONSTRAINT FK_7AB2D714B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_7AB2D714B1E7706E ON probleme (restaurant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE probleme DROP FOREIGN KEY FK_7AB2D714B1E7706E');
        $this->addSql('DROP INDEX IDX_7AB2D714B1E7706E ON probleme');
        $this->addSql('ALTER TABLE probleme DROP restaurant_id');
    }
}
