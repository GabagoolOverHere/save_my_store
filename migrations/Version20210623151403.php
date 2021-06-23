<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623151403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE probleme ADD type_probleme_id INT NOT NULL');
        $this->addSql('ALTER TABLE probleme ADD CONSTRAINT FK_7AB2D714DD61980F FOREIGN KEY (type_probleme_id) REFERENCES type_probleme (id)');
        $this->addSql('CREATE INDEX IDX_7AB2D714DD61980F ON probleme (type_probleme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE probleme DROP FOREIGN KEY FK_7AB2D714DD61980F');
        $this->addSql('DROP INDEX IDX_7AB2D714DD61980F ON probleme');
        $this->addSql('ALTER TABLE probleme DROP type_probleme_id');
    }
}
