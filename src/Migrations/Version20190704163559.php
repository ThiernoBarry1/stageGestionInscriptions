<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190704163559 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE projet_presente (id INT AUTO_INCREMENT NOT NULL, projet_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, auteurrealisateur VARCHAR(255) DEFAULT NULL, genre VARCHAR(15) DEFAULT NULL, duree_envisagee VARCHAR(20) DEFAULT NULL, cout_previsionnel VARCHAR(50) DEFAULT NULL, INDEX IDX_4B7428C4C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet_presente ADD CONSTRAINT FK_4B7428C4C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE projet ADD nombre_salarie_permanent INT DEFAULT NULL, ADD nombre_salarie_intermittent INT DEFAULT NULL, ADD salarie_permenent_eqtemps INT DEFAULT NULL, ADD salarie_intermittentth VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE projet_presente');
        $this->addSql('ALTER TABLE projet DROP nombre_salarie_permanent, DROP nombre_salarie_intermittent, DROP salarie_permenent_eqtemps, DROP salarie_intermittentth');
    }
}
