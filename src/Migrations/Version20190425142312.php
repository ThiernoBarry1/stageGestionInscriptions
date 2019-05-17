<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425142312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4C641BB25');
        $this->addSql('DROP INDEX IDX_D044D5D4C641BB25 ON session');
        $this->addSql('ALTER TABLE session CHANGE fond_aide_id fonds_aide_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D49F52646B FOREIGN KEY (fonds_aide_id) REFERENCES fonds_aide (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D49F52646B ON session (fonds_aide_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D49F52646B');
        $this->addSql('DROP INDEX IDX_D044D5D49F52646B ON session');
        $this->addSql('ALTER TABLE session CHANGE fonds_aide_id fond_aide_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4C641BB25 FOREIGN KEY (fond_aide_id) REFERENCES fonds_aide (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D4C641BB25 ON session (fond_aide_id)');
    }
}
