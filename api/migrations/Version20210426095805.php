<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426095805 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gestion_heure (id INT AUTO_INCREMENT NOT NULL, plage_horaire_id INT DEFAULT NULL, date_entree DATE NOT NULL, date_sortie DATE NOT NULL, type TINYINT(1) NOT NULL, INDEX IDX_5C6C875BB6BCB98B (plage_horaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestion_heure_profil (gestion_heure_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_E09BE66F366E27C2 (gestion_heure_id), INDEX IDX_E09BE66F275ED078 (profil_id), PRIMARY KEY(gestion_heure_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jours (id INT AUTO_INCREMENT NOT NULL, jours VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jours_gestion_heure (jours_id INT NOT NULL, gestion_heure_id INT NOT NULL, INDEX IDX_205F9EFD6180639B (jours_id), INDEX IDX_205F9EFD366E27C2 (gestion_heure_id), PRIMARY KEY(jours_id, gestion_heure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, aura_un_id INT DEFAULT NULL, info_entree DATETIME NOT NULL, INDEX IDX_8F3F68C52A3C1991 (aura_un_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plage_horaire (id INT AUTO_INCREMENT NOT NULL, heure_entree TIME NOT NULL, heure_sortie TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, utilisateurs_id INT DEFAULT NULL, immatriculation VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, url_photo VARCHAR(255) NOT NULL, invite TINYINT(1) NOT NULL, INDEX IDX_E6D6B2971E969C5 (utilisateurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gestion_heure ADD CONSTRAINT FK_5C6C875BB6BCB98B FOREIGN KEY (plage_horaire_id) REFERENCES plage_horaire (id)');
        $this->addSql('ALTER TABLE gestion_heure_profil ADD CONSTRAINT FK_E09BE66F366E27C2 FOREIGN KEY (gestion_heure_id) REFERENCES gestion_heure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gestion_heure_profil ADD CONSTRAINT FK_E09BE66F275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jours_gestion_heure ADD CONSTRAINT FK_205F9EFD6180639B FOREIGN KEY (jours_id) REFERENCES jours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jours_gestion_heure ADD CONSTRAINT FK_205F9EFD366E27C2 FOREIGN KEY (gestion_heure_id) REFERENCES gestion_heure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C52A3C1991 FOREIGN KEY (aura_un_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B2971E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gestion_heure_profil DROP FOREIGN KEY FK_E09BE66F366E27C2');
        $this->addSql('ALTER TABLE jours_gestion_heure DROP FOREIGN KEY FK_205F9EFD366E27C2');
        $this->addSql('ALTER TABLE jours_gestion_heure DROP FOREIGN KEY FK_205F9EFD6180639B');
        $this->addSql('ALTER TABLE gestion_heure DROP FOREIGN KEY FK_5C6C875BB6BCB98B');
        $this->addSql('ALTER TABLE gestion_heure_profil DROP FOREIGN KEY FK_E09BE66F275ED078');
        $this->addSql('ALTER TABLE log DROP FOREIGN KEY FK_8F3F68C52A3C1991');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B2971E969C5');
        $this->addSql('DROP TABLE gestion_heure');
        $this->addSql('DROP TABLE gestion_heure_profil');
        $this->addSql('DROP TABLE jours');
        $this->addSql('DROP TABLE jours_gestion_heure');
        $this->addSql('DROP TABLE log');
        $this->addSql('DROP TABLE plage_horaire');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
