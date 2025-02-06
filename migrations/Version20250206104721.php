<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206104721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches_tournaments DROP FOREIGN KEY FK_CA209B2C4B30DD19');
        $this->addSql('ALTER TABLE matches_tournaments DROP FOREIGN KEY FK_CA209B2CD92C1B5D');
        $this->addSql('DROP TABLE matches_tournaments');
        $this->addSql('ALTER TABLE matches ADD tournament_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BABE120E4E FOREIGN KEY (tournament_id_id) REFERENCES tournaments (id)');
        $this->addSql('CREATE INDEX IDX_62615BABE120E4E ON matches (tournament_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matches_tournaments (matches_id INT NOT NULL, tournaments_id INT NOT NULL, INDEX IDX_CA209B2C4B30DD19 (matches_id), INDEX IDX_CA209B2CD92C1B5D (tournaments_id), PRIMARY KEY(matches_id, tournaments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE matches_tournaments ADD CONSTRAINT FK_CA209B2C4B30DD19 FOREIGN KEY (matches_id) REFERENCES matches (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matches_tournaments ADD CONSTRAINT FK_CA209B2CD92C1B5D FOREIGN KEY (tournaments_id) REFERENCES tournaments (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BABE120E4E');
        $this->addSql('DROP INDEX IDX_62615BABE120E4E ON matches');
        $this->addSql('ALTER TABLE matches DROP tournament_id_id');
    }
}
