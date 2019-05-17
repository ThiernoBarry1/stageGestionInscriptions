<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425090915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document_audio_visuels ADD projet_id INT DEFAULT NULL, ADD mot_de_passe VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE document_audio_visuels ADD CONSTRAINT FK_89FC0EFDC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_89FC0EFDC18272 ON document_audio_visuels (projet_id)');
        $this->addSql('ALTER TABLE projet ADD type_aide_lm VARCHAR(255) DEFAULT NULL, ADD type_daide_doc VARCHAR(255) DEFAULT NULL, ADD mt_budget VARCHAR(255) DEFAULT NULL, ADD liens_eligibilite VARCHAR(255) DEFAULT NULL, ADD date_preparation VARCHAR(255) DEFAULT NULL, ADD date_tournage VARCHAR(255) DEFAULT NULL, ADD date_diffusion VARCHAR(255) DEFAULT NULL, ADD castion_envisage VARCHAR(255) DEFAULT NULL, ADD liste_liens_tournage VARCHAR(255) DEFAULT NULL, ADD nombre_jours_tournage INT NOT NULL, ADD nombre_jours_total INT NOT NULL, ADD droit_artistique_ht DOUBLE PRECISION DEFAULT NULL, ADD droit_artistique_drnht INT DEFAULT NULL, ADD personnel INT DEFAULT NULL, ADD personnel_drnht INT DEFAULT NULL, ADD interpretation_ht DOUBLE PRECISION DEFAULT NULL, ADD interpretation_dnht DOUBLE PRECISION DEFAULT NULL, ADD total_charge_sociales_ht DOUBLE PRECISION NOT NULL, ADD total_charge_sociales_dnht DOUBLE PRECISION DEFAULT NULL, ADD deco_et_costumes DOUBLE PRECISION DEFAULT NULL, ADD deco_et_costumes_dnht DOUBLE PRECISION DEFAULT NULL, ADD transport_ht DOUBLE PRECISION DEFAULT NULL, ADD transport_dnht DOUBLE PRECISION DEFAULT NULL, ADD moyen_technique_tournage DOUBLE PRECISION DEFAULT NULL, ADD post_prod DOUBLE PRECISION DEFAULT NULL, ADD moyen_technique_tournage_dnht DOUBLE PRECISION DEFAULT NULL, ADD post_prod_dnht DOUBLE PRECISION DEFAULT NULL, ADD assurance_et_frais DOUBLE PRECISION DEFAULT NULL, ADD assurance_et_frais_dnht DOUBLE PRECISION DEFAULT NULL, ADD frais_financiers_ht DOUBLE PRECISION DEFAULT NULL, ADD frais_financiers_dnht DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_ht DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_dnht DOUBLE PRECISION DEFAULT NULL, ADD inprevus DOUBLE PRECISION DEFAULT NULL, ADD inprevus_dnht DOUBLE PRECISION DEFAULT NULL, ADD total_general_ht DOUBLE PRECISION DEFAULT NULL, ADD total_general_dnht DOUBLE PRECISION DEFAULT NULL, ADD financement_acquis TINYINT(1) NOT NULL, ADD financement_acquis_precision LONGTEXT NOT NULL, ADD string VARCHAR(255) DEFAULT NULL, ADD depot_projet_collectivite TINYINT(1) NOT NULL, ADD depot_projet_collectivite_precision LONGTEXT DEFAULT NULL, ADD projet_deja_presenter_fa TINYINT(1) DEFAULT NULL, ADD projet_deja_presente_fadate VARCHAR(255) DEFAULT NULL, ADD projet_deja_presente_fatype_aide VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document_audio_visuels DROP FOREIGN KEY FK_89FC0EFDC18272');
        $this->addSql('DROP INDEX IDX_89FC0EFDC18272 ON document_audio_visuels');
        $this->addSql('ALTER TABLE document_audio_visuels DROP projet_id, DROP mot_de_passe');
        $this->addSql('ALTER TABLE projet DROP type_aide_lm, DROP type_daide_doc, DROP mt_budget, DROP liens_eligibilite, DROP date_preparation, DROP date_tournage, DROP date_diffusion, DROP castion_envisage, DROP liste_liens_tournage, DROP nombre_jours_tournage, DROP nombre_jours_total, DROP droit_artistique_ht, DROP droit_artistique_drnht, DROP personnel, DROP personnel_drnht, DROP interpretation_ht, DROP interpretation_dnht, DROP total_charge_sociales_ht, DROP total_charge_sociales_dnht, DROP deco_et_costumes, DROP deco_et_costumes_dnht, DROP transport_ht, DROP transport_dnht, DROP moyen_technique_tournage, DROP post_prod, DROP moyen_technique_tournage_dnht, DROP post_prod_dnht, DROP assurance_et_frais, DROP assurance_et_frais_dnht, DROP frais_financiers_ht, DROP frais_financiers_dnht, DROP frais_generaux_ht, DROP frais_generaux_dnht, DROP inprevus, DROP inprevus_dnht, DROP total_general_ht, DROP total_general_dnht, DROP financement_acquis, DROP financement_acquis_precision, DROP string, DROP depot_projet_collectivite, DROP depot_projet_collectivite_precision, DROP projet_deja_presenter_fa, DROP projet_deja_presente_fadate, DROP projet_deja_presente_fatype_aide');
    }
}
