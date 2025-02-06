<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206203427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_tournament_teams DROP FOREIGN KEY FK_E00AB06046B38676');
        $this->addSql('ALTER TABLE team_tournament_teams DROP FOREIGN KEY FK_E00AB060D6365F12');
        $this->addSql('ALTER TABLE team_tournament_tournaments DROP FOREIGN KEY FK_44D6D97846B38676');
        $this->addSql('ALTER TABLE team_tournament_tournaments DROP FOREIGN KEY FK_44D6D978D92C1B5D');
        $this->addSql('DROP TABLE team_tournament_teams');
        $this->addSql('DROP TABLE team_tournament_tournaments');
        $this->addSql('ALTER TABLE team_tournament ADD tournament_id_id INT NOT NULL, ADD team_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1CBE120E4E FOREIGN KEY (tournament_id_id) REFERENCES tournaments (id)');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1CB842D717 FOREIGN KEY (team_id_id) REFERENCES teams (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8386CA1CBE120E4E ON team_tournament (tournament_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8386CA1CB842D717 ON team_tournament (team_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_tournament_teams (team_tournament_id INT NOT NULL, teams_id INT NOT NULL, INDEX IDX_E00AB06046B38676 (team_tournament_id), INDEX IDX_E00AB060D6365F12 (teams_id), PRIMARY KEY(team_tournament_id, teams_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE team_tournament_tournaments (team_tournament_id INT NOT NULL, tournaments_id INT NOT NULL, INDEX IDX_44D6D97846B38676 (team_tournament_id), INDEX IDX_44D6D978D92C1B5D (tournaments_id), PRIMARY KEY(team_tournament_id, tournaments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE team_tournament_teams ADD CONSTRAINT FK_E00AB06046B38676 FOREIGN KEY (team_tournament_id) REFERENCES team_tournament (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_tournament_teams ADD CONSTRAINT FK_E00AB060D6365F12 FOREIGN KEY (teams_id) REFERENCES teams (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_tournament_tournaments ADD CONSTRAINT FK_44D6D97846B38676 FOREIGN KEY (team_tournament_id) REFERENCES team_tournament (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_tournament_tournaments ADD CONSTRAINT FK_44D6D978D92C1B5D FOREIGN KEY (tournaments_id) REFERENCES tournaments (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1CBE120E4E');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1CB842D717');
        $this->addSql('DROP INDEX UNIQ_8386CA1CBE120E4E ON team_tournament');
        $this->addSql('DROP INDEX UNIQ_8386CA1CB842D717 ON team_tournament');
        $this->addSql('ALTER TABLE team_tournament DROP tournament_id_id, DROP team_id_id');
    }
}
