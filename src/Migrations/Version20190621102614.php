<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190621102614 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD droit_artistiques_france DOUBLE PRECISION DEFAULT NULL, ADD personnel_france DOUBLE PRECISION DEFAULT NULL, ADD interpretation_france DOUBLE PRECISION DEFAULT NULL, ADD charge_sociale_france DOUBLE PRECISION DEFAULT NULL, ADD deco_et_costumes_france DOUBLE PRECISION DEFAULT NULL, ADD transport_france DOUBLE PRECISION DEFAULT NULL, ADD moyen_technique_france DOUBLE PRECISION DEFAULT NULL, ADD post_prod_france DOUBLE PRECISION DEFAULT NULL, ADD assurance_france DOUBLE PRECISION DEFAULT NULL, ADD frais_financiers_france DOUBLE PRECISION DEFAULT NULL, ADD frais_generaux_france DOUBLE PRECISION DEFAULT NULL, ADD imprevus_france DOUBLE PRECISION DEFAULT NULL, ADD total_general_france DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet DROP droit_artistiques_france, DROP personnel_france, DROP interpretation_france, DROP charge_sociale_france, DROP deco_et_costumes_france, DROP transport_france, DROP moyen_technique_france, DROP post_prod_france, DROP assurance_france, DROP frais_financiers_france, DROP frais_generaux_france, DROP imprevus_france, DROP total_general_france');
    }
}
