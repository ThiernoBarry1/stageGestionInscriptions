<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425135706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD type_aide_doc VARCHAR(255) DEFAULT NULL, ADD casting_envisage VARCHAR(255) DEFAULT NULL, ADD droit_artistique_total_ht DOUBLE PRECISION DEFAULT NULL, ADD droit_artistique_total_ht_normandie INT DEFAULT NULL, ADD personnel_tolal_ht INT DEFAULT NULL, ADD personnel_total_ht_noramndie INT DEFAULT NULL, ADD interpretation_total_ht DOUBLE PRECISION DEFAULT NULL, ADD interpretation_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD total_charge_sociales_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD deco_et_costumes_total_ht DOUBLE PRECISION DEFAULT NULL, ADD deco_et_costumes_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD transport_total_ht DOUBLE PRECISION DEFAULT NULL, ADD transport_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD moyen_technique_tournage_total_ht DOUBLE PRECISION DEFAULT NULL, ADD post_prod_total_ht DOUBLE PRECISION DEFAULT NULL, ADD moyen_technique_tournage_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD post_prod_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD assurance_et_frais_total_ht DOUBLE PRECISION DEFAULT NULL, ADD assurance_et_frais_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD frais_financiers_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_total_ht DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD imprevus_total_ht DOUBLE PRECISION DEFAULT NULL, ADD imprevus_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD total_general_total_ht DOUBLE PRECISION DEFAULT NULL, ADD total_general_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, ADD projet_deja_presente_fond_aide_date VARCHAR(255) DEFAULT NULL, ADD projet_deja_presente_fond_aide_type_aide VARCHAR(255) DEFAULT NULL, DROP type_daide_doc, DROP castion_envisage, DROP droit_artistique_ht, DROP droit_artistique_drnht, DROP personnel, DROP personnel_drnht, DROP interpretation_ht, DROP interpretation_dnht, DROP total_charge_sociales_dnht, DROP deco_et_costumes, DROP deco_et_costumes_dnht, DROP transport_ht, DROP transport_dnht, DROP moyen_technique_tournage, DROP post_prod, DROP moyen_technique_tournage_dnht, DROP post_prod_dnht, DROP assurance_et_frais, DROP assurance_et_frais_dnht, DROP frais_financiers_dnht, DROP frais_generaux_ht, DROP frais_generaux_dnht, DROP inprevus, DROP inprevus_dnht, DROP total_general_ht, DROP total_general_dnht, DROP string, DROP projet_deja_presente_fadate, DROP projet_deja_presente_fatype_aide, CHANGE titre titre VARCHAR(255) DEFAULT NULL, CHANGE duree duree INT DEFAULT NULL, CHANGE format_tournage format_tournage VARCHAR(255) DEFAULT NULL, CHANGE nombre_jours_tournage nombre_jours_tournage INT DEFAULT NULL, CHANGE nombre_jours_total nombre_jours_total INT DEFAULT NULL, CHANGE total_charge_sociales_ht total_charge_sociales_total_ht DOUBLE PRECISION NOT NULL, CHANGE projet_deja_presenter_fa projet_deja_presente_fond_aide TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD type_daide_doc VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD castion_envisage VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD droit_artistique_ht DOUBLE PRECISION DEFAULT NULL, ADD droit_artistique_drnht INT DEFAULT NULL, ADD personnel INT DEFAULT NULL, ADD personnel_drnht INT DEFAULT NULL, ADD interpretation_ht DOUBLE PRECISION DEFAULT NULL, ADD interpretation_dnht DOUBLE PRECISION DEFAULT NULL, ADD total_charge_sociales_dnht DOUBLE PRECISION DEFAULT NULL, ADD deco_et_costumes DOUBLE PRECISION DEFAULT NULL, ADD deco_et_costumes_dnht DOUBLE PRECISION DEFAULT NULL, ADD transport_ht DOUBLE PRECISION DEFAULT NULL, ADD transport_dnht DOUBLE PRECISION DEFAULT NULL, ADD moyen_technique_tournage DOUBLE PRECISION DEFAULT NULL, ADD post_prod DOUBLE PRECISION DEFAULT NULL, ADD moyen_technique_tournage_dnht DOUBLE PRECISION DEFAULT NULL, ADD post_prod_dnht DOUBLE PRECISION DEFAULT NULL, ADD assurance_et_frais DOUBLE PRECISION DEFAULT NULL, ADD assurance_et_frais_dnht DOUBLE PRECISION DEFAULT NULL, ADD frais_financiers_dnht DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_ht DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_dnht DOUBLE PRECISION DEFAULT NULL, ADD inprevus DOUBLE PRECISION DEFAULT NULL, ADD inprevus_dnht DOUBLE PRECISION DEFAULT NULL, ADD total_general_ht DOUBLE PRECISION DEFAULT NULL, ADD total_general_dnht DOUBLE PRECISION DEFAULT NULL, ADD string VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD projet_deja_presente_fadate VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD projet_deja_presente_fatype_aide VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP type_aide_doc, DROP casting_envisage, DROP droit_artistique_total_ht, DROP droit_artistique_total_ht_normandie, DROP personnel_tolal_ht, DROP personnel_total_ht_noramndie, DROP interpretation_total_ht, DROP interpretation_total_ht_normandie, DROP total_charge_sociales_total_ht_normandie, DROP deco_et_costumes_total_ht, DROP deco_et_costumes_total_ht_normandie, DROP transport_total_ht, DROP transport_total_ht_normandie, DROP moyen_technique_tournage_total_ht, DROP post_prod_total_ht, DROP moyen_technique_tournage_total_ht_normandie, DROP post_prod_total_ht_normandie, DROP assurance_et_frais_total_ht, DROP assurance_et_frais_total_ht_normandie, DROP frais_financiers_total_ht_normandie, DROP frais_generaux_total_ht, DROP frais_generaux_total_ht_normandie, DROP imprevus_total_ht, DROP imprevus_total_ht_normandie, DROP total_general_total_ht, DROP total_general_total_ht_normandie, DROP projet_deja_presente_fond_aide_date, DROP projet_deja_presente_fond_aide_type_aide, CHANGE titre titre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE duree duree INT NOT NULL, CHANGE format_tournage format_tournage VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE nombre_jours_tournage nombre_jours_tournage INT NOT NULL, CHANGE nombre_jours_total nombre_jours_total INT NOT NULL, CHANGE total_charge_sociales_total_ht total_charge_sociales_ht DOUBLE PRECISION NOT NULL, CHANGE projet_deja_presente_fond_aide projet_deja_presenter_fa TINYINT(1) DEFAULT NULL');
    }
}
