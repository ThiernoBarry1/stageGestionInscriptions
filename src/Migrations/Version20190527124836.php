<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190527124836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE auteur_realisateur (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(100) DEFAULT NULL, pseudonyme VARCHAR(150) DEFAULT NULL, adresse VARCHAR(60) DEFAULT NULL, code_postal VARCHAR(6) DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, telephone_mobile VARCHAR(255) DEFAULT NULL, courriel VARCHAR(255) DEFAULT NULL, type_personne VARCHAR(25) DEFAULT NULL, pourcentage_auteur_realisateur VARCHAR(50) DEFAULT NULL, INDEX IDX_53E9C97DC18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_audio_visuels (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, titre VARCHAR(255) DEFAULT NULL, realisateur VARCHAR(255) DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, annee INT DEFAULT NULL, duree INT DEFAULT NULL, mot_de_passe VARCHAR(255) DEFAULT NULL, lien VARCHAR(255) DEFAULT NULL, INDEX IDX_89FC0EFDC18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonds_aide (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producteur (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, nature VARCHAR(255) DEFAULT NULL, siret VARCHAR(14) DEFAULT NULL, nom_gerant VARCHAR(50) DEFAULT NULL, prenom_gerant VARCHAR(100) DEFAULT NULL, nom_producteur VARCHAR(50) DEFAULT NULL, prenom_producteur VARCHAR(100) DEFAULT NULL, adresse VARCHAR(60) DEFAULT NULL, code_postal VARCHAR(6) DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, adresse_bureau VARCHAR(60) DEFAULT NULL, code_postale_bureau VARCHAR(6) DEFAULT NULL, ville_bureau VARCHAR(6) DEFAULT NULL, prenom_personne_chargee VARCHAR(255) DEFAULT NULL, nom_personne_chargee VARCHAR(255) DEFAULT NULL, telephone_mobile_personne_chargee VARCHAR(255) DEFAULT NULL, telephone_fixe_personne_chargee VARCHAR(255) DEFAULT NULL, courriel_personne_chargee VARCHAR(255) DEFAULT NULL, telephone_mobile_producteur VARCHAR(255) DEFAULT NULL, telephone_fixe_producteur VARCHAR(255) DEFAULT NULL, courriel_producteur VARCHAR(255) DEFAULT NULL, INDEX IDX_7EDBEE10C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, session_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, duree INT DEFAULT NULL, format_tournage VARCHAR(255) DEFAULT NULL, format_definitif VARCHAR(255) DEFAULT NULL, genre VARCHAR(20) DEFAULT NULL, synopsis LONGTEXT DEFAULT NULL, adaptation_oeuvre TINYINT(1) DEFAULT NULL, deposant TINYINT(1) DEFAULT NULL, type_aide_lm VARCHAR(15) DEFAULT NULL, type_aide_doc VARCHAR(20) DEFAULT NULL, mt_budget VARCHAR(255) DEFAULT NULL, liens_eligibilite LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', date_preparation VARCHAR(255) DEFAULT NULL, date_tournage VARCHAR(255) DEFAULT NULL, date_diffusion VARCHAR(255) DEFAULT NULL, casting_envisage VARCHAR(255) DEFAULT NULL, lieux_tournage LONGTEXT DEFAULT NULL, nombre_jours_tournage INT DEFAULT NULL, nombre_jours_total INT DEFAULT NULL, droit_artistique_total_ht DOUBLE PRECISION DEFAULT NULL, droit_artistique_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, personnel_total_ht DOUBLE PRECISION DEFAULT NULL, personnel_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, interpretation_total_ht DOUBLE PRECISION DEFAULT NULL, interpretation_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, total_charge_sociales_total_ht DOUBLE PRECISION DEFAULT NULL, total_charge_sociales_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, deco_et_costumes_total_ht DOUBLE PRECISION DEFAULT NULL, deco_et_costumes_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, transport_total_ht DOUBLE PRECISION DEFAULT NULL, transport_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, moyen_technique_tournage_total_ht DOUBLE PRECISION DEFAULT NULL, post_prod_total_ht DOUBLE PRECISION DEFAULT NULL, moyen_technique_tournage_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, post_prod_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, assurance_et_frais_total_ht DOUBLE PRECISION DEFAULT NULL, assurance_et_frais_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, frais_financiers_total_ht DOUBLE PRECISION DEFAULT NULL, frais_financiers_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, frais_generaux_total_ht DOUBLE PRECISION DEFAULT NULL, frais_generaux_total_ht_normandie DOUBLE PRECISION DEFAULT NULL, imprevus_total_ht INT DEFAULT NULL, imprevus_total_ht_normandie INT DEFAULT NULL, total_general_total_ht INT DEFAULT NULL, total_general_total_ht_normandie INT DEFAULT NULL, financement_acquis TINYINT(1) DEFAULT NULL, financement_acquis_precision LONGTEXT DEFAULT NULL, depot_projet_collectivite TINYINT(1) DEFAULT NULL, depot_projet_collectivite_precision LONGTEXT DEFAULT NULL, projet_deja_presente_fonds_aide TINYINT(1) DEFAULT NULL, projet_deja_presente_fonds_aide_date VARCHAR(55) DEFAULT NULL, projet_deja_presente_fonds_aide_type_aide VARCHAR(255) DEFAULT NULL, genre_precision_autre VARCHAR(255) DEFAULT NULL, adaptation_oeuvre_toa VARCHAR(255) DEFAULT NULL, adaptation_oeuvre_dacp VARCHAR(255) DEFAULT NULL, adaptation_oeuvre_dfc DATETIME DEFAULT NULL, montant_sollicite VARCHAR(255) DEFAULT NULL, modified_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, type_film VARCHAR(25) DEFAULT NULL, type_oeuvre VARCHAR(255) DEFAULT NULL, duree_episode VARCHAR(255) DEFAULT NULL, nom_fichier VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_50159CA9613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, fonds_aide_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_debut DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, preselection DATETIME DEFAULT NULL, pleniere DATETIME DEFAULT NULL, numerus_clausus INT DEFAULT NULL, INDEX IDX_D044D5D49F52646B (fonds_aide_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur_realisateur ADD CONSTRAINT FK_53E9C97DC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE document_audio_visuels ADD CONSTRAINT FK_89FC0EFDC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE producteur ADD CONSTRAINT FK_7EDBEE10C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D49F52646B FOREIGN KEY (fonds_aide_id) REFERENCES fonds_aide (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D49F52646B');
        $this->addSql('ALTER TABLE auteur_realisateur DROP FOREIGN KEY FK_53E9C97DC18272');
        $this->addSql('ALTER TABLE document_audio_visuels DROP FOREIGN KEY FK_89FC0EFDC18272');
        $this->addSql('ALTER TABLE producteur DROP FOREIGN KEY FK_7EDBEE10C18272');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9613FECDF');
        $this->addSql('DROP TABLE auteur_realisateur');
        $this->addSql('DROP TABLE document_audio_visuels');
        $this->addSql('DROP TABLE fonds_aide');
        $this->addSql('DROP TABLE producteur');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE session');
    }
}
