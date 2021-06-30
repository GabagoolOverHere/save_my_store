<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210630090436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD patron_prestataire_id INT DEFAULT NULL, ADD patron_restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D766783D422 FOREIGN KEY (patron_prestataire_id) REFERENCES patron_prestataire (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76D9DB3987 FOREIGN KEY (patron_restaurant_id) REFERENCES patron_restaurant (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D766783D422 ON admin (patron_prestataire_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76D9DB3987 ON admin (patron_restaurant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D766783D422');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76D9DB3987');
        $this->addSql('DROP INDEX UNIQ_880E0D766783D422 ON admin');
        $this->addSql('DROP INDEX UNIQ_880E0D76D9DB3987 ON admin');
        $this->addSql('ALTER TABLE admin DROP patron_prestataire_id, DROP patron_restaurant_id');
    }
}
