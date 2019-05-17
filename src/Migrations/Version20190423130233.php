<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190423130233 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE producteur (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, nom VARCHAR(255) NOT NULL, nature VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, nom_gerant VARCHAR(255) DEFAULT NULL, prenom_gerant VARCHAR(255) DEFAULT NULL, nom_producteur VARCHAR(255) DEFAULT NULL, prenom_producteur VARCHAR(255) DEFAULT NULL, personne_chargee VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, adresse_bureau VARCHAR(255) DEFAULT NULL, code_postale_bureau VARCHAR(255) DEFAULT NULL, ville_bureau VARCHAR(255) DEFAULT NULL, telephone_fixe VARCHAR(255) DEFAULT NULL, telephone_mobile VARCHAR(255) DEFAULT NULL, courriel VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7EDBEE10C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE producteur ADD CONSTRAINT FK_7EDBEE10C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE producteur');
    }
}
