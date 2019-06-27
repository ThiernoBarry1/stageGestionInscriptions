<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190627080735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD pellicules_total_ht DOUBLE PRECISION DEFAULT NULL, ADD pellicules_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD pellicules_france DOUBLE PRECISION DEFAULT NULL, DROP pellicule_total_ht, DROP pellicule_total_ht_normandie, DROP pellicule_france');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD pellicule_total_ht DOUBLE PRECISION DEFAULT NULL, ADD pellicule_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD pellicule_france DOUBLE PRECISION DEFAULT NULL, DROP pellicules_total_ht, DROP pellicules_total_ht_normandie, DROP pellicules_france');
    }
}
