<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190827142705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet CHANGE adaptation_oeuvre adaptation_oeuvre VARCHAR(3) DEFAULT NULL, CHANGE financement_acquis financement_acquis VARCHAR(3) DEFAULT NULL, CHANGE depot_projet_collectivite depot_projet_collectivite VARCHAR(3) DEFAULT NULL, CHANGE projet_deja_presente_fonds_aide projet_deja_presente_fonds_aide VARCHAR(3) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet CHANGE adaptation_oeuvre adaptation_oeuvre TINYINT(1) DEFAULT NULL, CHANGE financement_acquis financement_acquis TINYINT(1) DEFAULT NULL, CHANGE depot_projet_collectivite depot_projet_collectivite TINYINT(1) DEFAULT NULL, CHANGE projet_deja_presente_fonds_aide projet_deja_presente_fonds_aide TINYINT(1) DEFAULT NULL');
    }
}
