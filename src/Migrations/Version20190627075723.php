<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190627075723 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE producteur CHANGE ville_bureau ville_bureau VARCHAR(60) DEFAULT NULL, CHANGE prenom_personne_chargee prenom_personne_chargee VARCHAR(100) DEFAULT NULL, CHANGE nom_personne_chargee nom_personne_chargee VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD pellicule_total_ht DOUBLE PRECISION DEFAULT NULL, ADD pellicule_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD total_partiel_total_ht DOUBLE PRECISION DEFAULT NULL, ADD total_partiel_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD pellicule_france DOUBLE PRECISION DEFAULT NULL, ADD total_partiel_france DOUBLE PRECISION DEFAULT NULL, DROP post_prod_total_ht, DROP post_prod_total_ht_normandie, DROP frais_financiers_total_ht, DROP frais_financiers_total_ht_normandie, DROP frais_generaux_total_ht, DROP frais_generaux_total_ht_normandie, DROP imprevus_total_ht, DROP imprevus_total_ht_normandie, DROP post_prod_france, DROP frais_financiers_france, DROP frais_generaux_france, DROP imprevus_france, CHANGE duree_episode duree_episode INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE producteur CHANGE ville_bureau ville_bureau VARCHAR(6) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE prenom_personne_chargee prenom_personne_chargee VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom_personne_chargee nom_personne_chargee VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE projet ADD post_prod_total_ht DOUBLE PRECISION DEFAULT NULL, ADD post_prod_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD frais_financiers_total_ht DOUBLE PRECISION DEFAULT NULL, ADD frais_financiers_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_total_ht DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD imprevus_total_ht DOUBLE PRECISION DEFAULT NULL, ADD imprevus_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD post_prod_france DOUBLE PRECISION DEFAULT NULL, ADD frais_financiers_france DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_france DOUBLE PRECISION DEFAULT NULL, ADD imprevus_france DOUBLE PRECISION DEFAULT NULL, DROP pellicule_total_ht, DROP pellicule_total_ht_normandie, DROP total_partiel_total_ht, DROP total_partiel_total_ht_normandie, DROP pellicule_france, DROP total_partiel_france, CHANGE duree_episode duree_episode VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
