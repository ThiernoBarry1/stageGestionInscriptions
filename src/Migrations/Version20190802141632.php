<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802141632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD how_is_submitted VARCHAR(10) DEFAULT NULL, DROP valider_et_transmettre_candidature, CHANGE nombre_episode nombre_episode VARCHAR(10) DEFAULT NULL, CHANGE total_general_cout_definitif total_general_cout_definitif DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD valider_et_transmettre_candidature LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', DROP how_is_submitted, CHANGE nombre_episode nombre_episode VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE total_general_cout_definitif total_general_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
