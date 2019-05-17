<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190507081538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet CHANGE liste_lieux_tournage liste_lieux_tournage LONGTEXT DEFAULT NULL, CHANGE financement_acquis_precision financement_acquis_precision LONGTEXT DEFAULT NULL, CHANGE droit_artistique_total_ht_normandie droit_artistique_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, CHANGE personnel_total_ht personnel_total_ht DOUBLE PRECISION DEFAULT NULL, CHANGE personnel_total_ht_normandie personnel_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, CHANGE projet_deja_presente_fonds_aide_date projet_deja_presente_fonds_aide_date VARCHAR(55) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet CHANGE liste_lieux_tournage liste_lieux_tournage VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE droit_artistique_total_ht_normandie droit_artistique_total_ht_normandie INT DEFAULT NULL, CHANGE personnel_total_ht personnel_total_ht INT DEFAULT NULL, CHANGE personnel_total_ht_normandie personnel_total_ht_normandie INT DEFAULT NULL, CHANGE financement_acquis_precision financement_acquis_precision LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE projet_deja_presente_fonds_aide_date projet_deja_presente_fonds_aide_date VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
