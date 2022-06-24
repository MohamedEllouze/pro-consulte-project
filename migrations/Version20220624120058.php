<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220624120058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specialist ADD COLUMN active BOOLEAN DEFAULT true');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__specialist AS SELECT id, first_name, last_name, online FROM specialist');
        $this->addSql('DROP TABLE specialist');
        $this->addSql('CREATE TABLE specialist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, online BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO specialist (id, first_name, last_name, online) SELECT id, first_name, last_name, online FROM __temp__specialist');
        $this->addSql('DROP TABLE __temp__specialist');
    }
}
