<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207142644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE statut');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BABE120E4E FOREIGN KEY (tournament_id_id) REFERENCES tournaments (id)');
        $this->addSql('CREATE INDEX IDX_62615BABE120E4E ON matches (tournament_id_id)');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1CB842D717');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1CBE120E4E');
        $this->addSql('DROP INDEX UNIQ_8386CA1CB842D717 ON team_tournament');
        $this->addSql('DROP INDEX UNIQ_8386CA1CBE120E4E ON team_tournament');
        $this->addSql('ALTER TABLE team_tournament ADD tournament_id INT NOT NULL, ADD team_id INT NOT NULL, DROP tournament_id_id, DROP team_id_id');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1C33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournaments (id)');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1C296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id)');
        $this->addSql('CREATE INDEX IDX_8386CA1C33D1A3E7 ON team_tournament (tournament_id)');
        $this->addSql('CREATE INDEX IDX_8386CA1C296CD8AE ON team_tournament (team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BABE120E4E');
        $this->addSql('DROP INDEX IDX_62615BABE120E4E ON matches');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1C33D1A3E7');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1C296CD8AE');
        $this->addSql('DROP INDEX IDX_8386CA1C33D1A3E7 ON team_tournament');
        $this->addSql('DROP INDEX IDX_8386CA1C296CD8AE ON team_tournament');
        $this->addSql('ALTER TABLE team_tournament ADD tournament_id_id INT NOT NULL, ADD team_id_id INT NOT NULL, DROP tournament_id, DROP team_id');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1CB842D717 FOREIGN KEY (team_id_id) REFERENCES teams (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1CBE120E4E FOREIGN KEY (tournament_id_id) REFERENCES tournaments (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8386CA1CB842D717 ON team_tournament (team_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8386CA1CBE120E4E ON team_tournament (tournament_id_id)');
    }
}
