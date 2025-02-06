<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206204328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1CBE120E4E FOREIGN KEY (tournament_id_id) REFERENCES tournaments (id)');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1CB842D717 FOREIGN KEY (team_id_id) REFERENCES teams (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8386CA1CBE120E4E ON team_tournament (tournament_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8386CA1CB842D717 ON team_tournament (team_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1CBE120E4E');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1CB842D717');
        $this->addSql('DROP INDEX UNIQ_8386CA1CBE120E4E ON team_tournament');
        $this->addSql('DROP INDEX UNIQ_8386CA1CB842D717 ON team_tournament');
    }
}
