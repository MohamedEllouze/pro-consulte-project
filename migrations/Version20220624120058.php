<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220624120058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add active column to specialist table';
    }

    public function up(Schema $schema): void
    {
        // Add 'active' column with a default value of 1 (true)
        $this->addSql('ALTER TABLE specialist ADD COLUMN active TINYINT(1) DEFAULT 1 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // Rollback: Remove the 'active' column
        $this->addSql('ALTER TABLE specialist DROP COLUMN active');
    }
}
