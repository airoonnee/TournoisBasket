<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206110658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches_tournaments DROP FOREIGN KEY FK_CA209B2C4B30DD19');
        $this->addSql('ALTER TABLE matches_tournaments ADD CONSTRAINT FK_CA209B2C4B30DD19 FOREIGN KEY (matches_id) REFERENCES matches (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches_tournaments DROP FOREIGN KEY FK_CA209B2C4B30DD19');
        $this->addSql('ALTER TABLE matches_tournaments ADD CONSTRAINT FK_CA209B2C4B30DD19 FOREIGN KEY (matches_id) REFERENCES matches (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
