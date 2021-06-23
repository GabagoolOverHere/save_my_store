<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623150349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire ADD quartier_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480DF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (id)');
        $this->addSql('CREATE INDEX IDX_60A26480DF1E57AB ON prestataire (quartier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480DF1E57AB');
        $this->addSql('DROP INDEX IDX_60A26480DF1E57AB ON prestataire');
        $this->addSql('ALTER TABLE prestataire DROP quartier_id');
    }
}
