<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523103753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE auteur_realisateur CHANGE projet_id projet_id INT DEFAULT NULL, CHANGE telephone_mobile telephone_mobile VARCHAR(255) DEFAULT NULL, CHANGE courriel courriel VARCHAR(255) DEFAULT NULL, CHANGE type_personne type_personne VARCHAR(25) DEFAULT NULL');
        $this->addSql('ALTER TABLE producteur CHANGE projet_id projet_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE auteur_realisateur CHANGE projet_id projet_id INT NOT NULL, CHANGE telephone_mobile telephone_mobile VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE courriel courriel VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE type_personne type_personne VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE producteur CHANGE projet_id projet_id INT NOT NULL');
    }
}
