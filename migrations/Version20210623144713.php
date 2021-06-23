<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623144713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant ADD patron_restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FD9DB3987 FOREIGN KEY (patron_restaurant_id) REFERENCES patron_restaurant (id)');
        $this->addSql('CREATE INDEX IDX_EB95123FD9DB3987 ON restaurant (patron_restaurant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FD9DB3987');
        $this->addSql('DROP INDEX IDX_EB95123FD9DB3987 ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP patron_restaurant_id');
    }
}
