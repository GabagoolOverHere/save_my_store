<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623150230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire ADD patron_prestataire_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A264806783D422 FOREIGN KEY (patron_prestataire_id) REFERENCES patron_prestataire (id)');
        $this->addSql('CREATE INDEX IDX_60A264806783D422 ON prestataire (patron_prestataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A264806783D422');
        $this->addSql('DROP INDEX IDX_60A264806783D422 ON prestataire');
        $this->addSql('ALTER TABLE prestataire DROP patron_prestataire_id');
    }
}
