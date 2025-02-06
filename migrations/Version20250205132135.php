<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205132135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches_teams DROP FOREIGN KEY FK_8E7F6A754B30DD19');
        $this->addSql('ALTER TABLE matches_teams DROP FOREIGN KEY FK_8E7F6A75D6365F12');
        $this->addSql('DROP TABLE matches_teams');
        $this->addSql('ALTER TABLE matches ADD team1_id_id INT DEFAULT NULL, ADD team2_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA58EE02AA FOREIGN KEY (team1_id_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA69061837 FOREIGN KEY (team2_id_id) REFERENCES teams (id)');
        $this->addSql('CREATE INDEX IDX_62615BA58EE02AA ON matches (team1_id_id)');
        $this->addSql('CREATE INDEX IDX_62615BA69061837 ON matches (team2_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matches_teams (matches_id INT NOT NULL, teams_id INT NOT NULL, INDEX IDX_8E7F6A754B30DD19 (matches_id), INDEX IDX_8E7F6A75D6365F12 (teams_id), PRIMARY KEY(matches_id, teams_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE matches_teams ADD CONSTRAINT FK_8E7F6A754B30DD19 FOREIGN KEY (matches_id) REFERENCES matches (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matches_teams ADD CONSTRAINT FK_8E7F6A75D6365F12 FOREIGN KEY (teams_id) REFERENCES teams (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA58EE02AA');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA69061837');
        $this->addSql('DROP INDEX IDX_62615BA58EE02AA ON matches');
        $this->addSql('DROP INDEX IDX_62615BA69061837 ON matches');
        $this->addSql('ALTER TABLE matches DROP team1_id_id, DROP team2_id_id');
    }
}
