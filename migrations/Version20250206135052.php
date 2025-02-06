<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206135052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA33D1A3E7');
        $this->addSql('DROP INDEX IDX_62615BA33D1A3E7 ON matches');
        $this->addSql('ALTER TABLE matches CHANGE tournament_id tournament_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BABE120E4E FOREIGN KEY (tournament_id_id) REFERENCES tournaments (id)');
        $this->addSql('CREATE INDEX IDX_62615BABE120E4E ON matches (tournament_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BABE120E4E');
        $this->addSql('DROP INDEX IDX_62615BABE120E4E ON matches');
        $this->addSql('ALTER TABLE matches CHANGE tournament_id_id tournament_id INT NOT NULL');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournaments (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_62615BA33D1A3E7 ON matches (tournament_id)');
    }
}
