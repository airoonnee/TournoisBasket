<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250224102703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matches (id INT AUTO_INCREMENT NOT NULL, tournament_id_id INT NOT NULL, team1_id_id INT DEFAULT NULL, team2_id_id INT DEFAULT NULL, round INT NOT NULL, team1_score INT NOT NULL, team2_score INT NOT NULL, match_date DATETIME NOT NULL, INDEX IDX_62615BABE120E4E (tournament_id_id), INDEX IDX_62615BA58EE02AA (team1_id_id), INDEX IDX_62615BA69061837 (team2_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE players (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, team_id_id INT NOT NULL, UNIQUE INDEX UNIQ_264E43A69D86650F (user_id_id), INDEX IDX_264E43A6B842D717 (team_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE results (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE results_matches (results_id INT NOT NULL, matches_id INT NOT NULL, INDEX IDX_B1AE9A938A30AB9 (results_id), INDEX IDX_B1AE9A934B30DD19 (matches_id), PRIMARY KEY(results_id, matches_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE results_teams (results_id INT NOT NULL, teams_id INT NOT NULL, INDEX IDX_F078A6708A30AB9 (results_id), INDEX IDX_F078A670D6365F12 (teams_id), PRIMARY KEY(results_id, teams_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_tournament (id INT AUTO_INCREMENT NOT NULL, tournament_id INT DEFAULT NULL, team_id INT NOT NULL, INDEX IDX_8386CA1C33D1A3E7 (tournament_id), INDEX IDX_8386CA1C296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournaments (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, max_teams INT NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, position_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, INDEX IDX_8D93D649DD842E46 (position_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BABE120E4E FOREIGN KEY (tournament_id_id) REFERENCES tournaments (id)');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA58EE02AA FOREIGN KEY (team1_id_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA69061837 FOREIGN KEY (team2_id_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A69D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A6B842D717 FOREIGN KEY (team_id_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE results_matches ADD CONSTRAINT FK_B1AE9A938A30AB9 FOREIGN KEY (results_id) REFERENCES results (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE results_matches ADD CONSTRAINT FK_B1AE9A934B30DD19 FOREIGN KEY (matches_id) REFERENCES matches (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE results_teams ADD CONSTRAINT FK_F078A6708A30AB9 FOREIGN KEY (results_id) REFERENCES results (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE results_teams ADD CONSTRAINT FK_F078A670D6365F12 FOREIGN KEY (teams_id) REFERENCES teams (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1C33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournaments (id)');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1C296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BABE120E4E');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA58EE02AA');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA69061837');
        $this->addSql('ALTER TABLE players DROP FOREIGN KEY FK_264E43A69D86650F');
        $this->addSql('ALTER TABLE players DROP FOREIGN KEY FK_264E43A6B842D717');
        $this->addSql('ALTER TABLE results_matches DROP FOREIGN KEY FK_B1AE9A938A30AB9');
        $this->addSql('ALTER TABLE results_matches DROP FOREIGN KEY FK_B1AE9A934B30DD19');
        $this->addSql('ALTER TABLE results_teams DROP FOREIGN KEY FK_F078A6708A30AB9');
        $this->addSql('ALTER TABLE results_teams DROP FOREIGN KEY FK_F078A670D6365F12');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1C33D1A3E7');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1C296CD8AE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DD842E46');
        $this->addSql('DROP TABLE matches');
        $this->addSql('DROP TABLE players');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE results');
        $this->addSql('DROP TABLE results_matches');
        $this->addSql('DROP TABLE results_teams');
        $this->addSql('DROP TABLE team_tournament');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE tournaments');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
