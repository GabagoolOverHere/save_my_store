<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210625131439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT NOT NULL, descriptif LONGTEXT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, date_facture DATETIME NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_9067F23CBE3DB2B7 (prestataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patron_prestataire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel INT NOT NULL, immeuble VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patron_restaurant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel INT NOT NULL, immeuble VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, patron_prestataire_id INT NOT NULL, quartier_id INT NOT NULL, nom VARCHAR(255) NOT NULL, immeuble VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, code_postal INT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, tarif DOUBLE PRECISION NOT NULL, email VARCHAR(255) NOT NULL, tel INT NOT NULL, INDEX IDX_60A264806783D422 (patron_prestataire_id), INDEX IDX_60A26480DF1E57AB (quartier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE probleme (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT DEFAULT NULL, mission_id INT DEFAULT NULL, type_probleme_id INT NOT NULL, intitule LONGTEXT NOT NULL, INDEX IDX_7AB2D714B1E7706E (restaurant_id), INDEX IDX_7AB2D714BE6CAE90 (mission_id), INDEX IDX_7AB2D714DD61980F (type_probleme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quartier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, patron_restaurant_id INT DEFAULT NULL, quartier_id INT NOT NULL, nom VARCHAR(255) NOT NULL, immeuble VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, code_postal INT NOT NULL, tel BIGINT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, camis INT NOT NULL, INDEX IDX_EB95123FD9DB3987 (patron_restaurant_id), INDEX IDX_EB95123FDF1E57AB (quartier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_probleme (id INT AUTO_INCREMENT NOT NULL, intitule LONGTEXT NOT NULL, violation_code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CBE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A264806783D422 FOREIGN KEY (patron_prestataire_id) REFERENCES patron_prestataire (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480DF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (id)');
        $this->addSql('ALTER TABLE probleme ADD CONSTRAINT FK_7AB2D714B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE probleme ADD CONSTRAINT FK_7AB2D714BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE probleme ADD CONSTRAINT FK_7AB2D714DD61980F FOREIGN KEY (type_probleme_id) REFERENCES type_probleme (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FD9DB3987 FOREIGN KEY (patron_restaurant_id) REFERENCES patron_restaurant (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FDF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE probleme DROP FOREIGN KEY FK_7AB2D714BE6CAE90');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A264806783D422');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FD9DB3987');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CBE3DB2B7');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480DF1E57AB');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FDF1E57AB');
        $this->addSql('ALTER TABLE probleme DROP FOREIGN KEY FK_7AB2D714B1E7706E');
        $this->addSql('ALTER TABLE probleme DROP FOREIGN KEY FK_7AB2D714DD61980F');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE patron_prestataire');
        $this->addSql('DROP TABLE patron_restaurant');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE probleme');
        $this->addSql('DROP TABLE quartier');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE type_probleme');
    }
}
