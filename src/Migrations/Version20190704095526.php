<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190704095526 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD droit_artitstique_cout_definitif VARCHAR(255) DEFAULT NULL, ADD personnel_cout_definitif VARCHAR(255) DEFAULT NULL, ADD interpretation_cout_definitif VARCHAR(255) DEFAULT NULL, ADD total_charges_sociales_cout_definitif VARCHAR(255) DEFAULT NULL, ADD deco_et_costumes_cout_definitif VARCHAR(255) DEFAULT NULL, ADD transport_cout_definitif VARCHAR(255) DEFAULT NULL, ADD moyen_technique_cout_definitif VARCHAR(255) DEFAULT NULL, ADD pellicules_cout_definitif VARCHAR(255) DEFAULT NULL, ADD assurance_et_frais_cout_definitif VARCHAR(255) DEFAULT NULL, ADD total_partiel_cout_definitif VARCHAR(255) DEFAULT NULL, ADD frais_generaux_cout_definitif VARCHAR(255) DEFAULT NULL, ADD imprevus_cout_definitif VARCHAR(255) DEFAULT NULL, ADD total_general_cout_definitif VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet DROP droit_artitstique_cout_definitif, DROP personnel_cout_definitif, DROP interpretation_cout_definitif, DROP total_charges_sociales_cout_definitif, DROP deco_et_costumes_cout_definitif, DROP transport_cout_definitif, DROP moyen_technique_cout_definitif, DROP pellicules_cout_definitif, DROP assurance_et_frais_cout_definitif, DROP total_partiel_cout_definitif, DROP frais_generaux_cout_definitif, DROP imprevus_cout_definitif, DROP total_general_cout_definitif');
    }
}
