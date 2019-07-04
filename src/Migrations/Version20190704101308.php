<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190704101308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD total_charge_sociales_cout_definitif DOUBLE PRECISION DEFAULT NULL, DROP total_charges_sociales_cout_definitif, CHANGE droit_artistique_cout_definitif droit_artistique_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE personnel_cout_definitif personnel_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE interpretation_cout_definitif interpretation_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE deco_et_costumes_cout_definitif deco_et_costumes_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE transport_cout_definitif transport_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE moyen_technique_cout_definitif moyen_technique_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE pellicules_cout_definitif pellicules_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE assurance_et_frais_cout_definitif assurance_et_frais_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE total_partiel_cout_definitif total_partiel_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE frais_generaux_cout_definitif frais_generaux_cout_definitif DOUBLE PRECISION DEFAULT NULL, CHANGE imprevus_cout_definitif imprevus_cout_definitif DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD total_charges_sociales_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP total_charge_sociales_cout_definitif, CHANGE droit_artistique_cout_definitif droit_artistique_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE personnel_cout_definitif personnel_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE interpretation_cout_definitif interpretation_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE deco_et_costumes_cout_definitif deco_et_costumes_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE transport_cout_definitif transport_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE moyen_technique_cout_definitif moyen_technique_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE pellicules_cout_definitif pellicules_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE assurance_et_frais_cout_definitif assurance_et_frais_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE total_partiel_cout_definitif total_partiel_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE frais_generaux_cout_definitif frais_generaux_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE imprevus_cout_definitif imprevus_cout_definitif VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
