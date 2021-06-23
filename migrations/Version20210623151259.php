<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623151259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE probleme ADD mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE probleme ADD CONSTRAINT FK_7AB2D714BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('CREATE INDEX IDX_7AB2D714BE6CAE90 ON probleme (mission_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE probleme DROP FOREIGN KEY FK_7AB2D714BE6CAE90');
        $this->addSql('DROP INDEX IDX_7AB2D714BE6CAE90 ON probleme');
        $this->addSql('ALTER TABLE probleme DROP mission_id');
    }
}
