<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207131947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matches CHANGE tournament_id tournament_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BABE120E4E FOREIGN KEY (tournament_id_id) REFERENCES tournaments (id)');
        $this->addSql('CREATE INDEX IDX_62615BABE120E4E ON matches (tournament_id_id)');
        $this->addSql('ALTER TABLE tournaments ADD statut_id INT NOT NULL');
        $this->addSql('ALTER TABLE tournaments ADD CONSTRAINT FK_E4BCFAC3F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E4BCFAC3F6203804 ON tournaments (statut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tournaments DROP FOREIGN KEY FK_E4BCFAC3F6203804');
        $this->addSql('DROP TABLE statut');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BABE120E4E');
        $this->addSql('DROP INDEX IDX_62615BABE120E4E ON matches');
        $this->addSql('ALTER TABLE matches CHANGE tournament_id_id tournament_id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_E4BCFAC3F6203804 ON tournaments');
        $this->addSql('ALTER TABLE tournaments DROP statut_id');
    }
}
