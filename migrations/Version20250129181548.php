<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250129181548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE specialist CHANGE active active TINYINT(1) NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE body body LONGTEXT NOT NULL, CHANGE headers headers LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE body body TEXT NOT NULL, CHANGE headers headers TEXT NOT NULL');
        $this->addSql('ALTER TABLE specialist CHANGE active active TINYINT(1) DEFAULT 1 NOT NULL, CHANGE description description TEXT DEFAULT NULL');
    }
}
