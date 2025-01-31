<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220624130255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Create temporary table to preserve data
        $this->addSql('CREATE TEMPORARY TABLE __temp__specialist AS SELECT id, first_name, last_name, online, active FROM specialist');
        
        // Drop the old 'specialist' table
        $this->addSql('DROP TABLE specialist');
        
        // Create the new 'specialist' table with updated structure
        $this->addSql('
            CREATE TABLE specialist (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255) NOT NULL,
                online TINYINT(1) NOT NULL,
                active TINYINT(1) NOT NULL DEFAULT 1,
                description TEXT DEFAULT NULL,
                mobile VARCHAR(255) DEFAULT NULL,
                email VARCHAR(255) DEFAULT NULL,
                city VARCHAR(255) DEFAULT NULL
            )
        ');

        // Insert data back into the new table
        $this->addSql('
            INSERT INTO specialist (id, first_name, last_name, online, active)
            SELECT id, first_name, last_name, online, active FROM __temp__specialist
        ');

        // Drop the temporary table
        $this->addSql('DROP TABLE __temp__specialist');
    }

    public function down(Schema $schema): void
    {
        // Create temporary table to preserve data
        $this->addSql('CREATE TEMPORARY TABLE __temp__specialist AS SELECT id, first_name, last_name, online, active FROM specialist');
        
        // Drop the current 'specialist' table
        $this->addSql('DROP TABLE specialist');
        
        // Create the old 'specialist' table structure
        $this->addSql('
            CREATE TABLE specialist (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255) NOT NULL,
                online TINYINT(1) NOT NULL,
                active TINYINT(1) DEFAULT 1 NOT NULL
            )
        ');

        // Insert the preserved data back into the old table
        $this->addSql('
            INSERT INTO specialist (id, first_name, last_name, online, active)
            SELECT id, first_name, last_name, online, active FROM __temp__specialist
        ');

        // Drop the temporary table
        $this->addSql('DROP TABLE __temp__specialist');
    }
}
