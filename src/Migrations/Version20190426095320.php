<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190426095320 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD projet_deja_presente_fonds_aide_date VARCHAR(255) DEFAULT NULL, ADD projet_deja_presente_fonds_aide_type_aide VARCHAR(255) DEFAULT NULL, DROP projet_deja_presente_fond_aide_date, DROP projet_deja_presente_fond_aide_type_aide, CHANGE projet_deja_presente_fond_aide projet_deja_presente_fonds_aide TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD projet_deja_presente_fond_aide_date VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD projet_deja_presente_fond_aide_type_aide VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP projet_deja_presente_fonds_aide_date, DROP projet_deja_presente_fonds_aide_type_aide, CHANGE projet_deja_presente_fonds_aide projet_deja_presente_fond_aide TINYINT(1) DEFAULT NULL');
    }
}
