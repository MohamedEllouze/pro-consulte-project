<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220624115816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration compatible with MySQL 8';
    }

    public function up(Schema $schema): void
    {
        // Create 'specialist' table
        $this->addSql('
            CREATE TABLE specialist (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255) NOT NULL,
                online TINYINT(1) NOT NULL
            )
        ');

        // Create 'messenger_messages' table
        $this->addSql('
            CREATE TABLE messenger_messages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                body TEXT NOT NULL,
                headers TEXT NOT NULL,
                queue_name VARCHAR(190) NOT NULL,
                created_at DATETIME NOT NULL,
                available_at DATETIME NOT NULL,
                delivered_at DATETIME DEFAULT NULL
            )
        ');

        // Add indexes to 'messenger_messages'
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // Drop tables on rollback
        $this->addSql('DROP TABLE IF EXISTS specialist');
        $this->addSql('DROP TABLE IF EXISTS messenger_messages');
    }
}
