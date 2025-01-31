<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250131200111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel DROP FOREIGN KEY FK_130D3BD31EC22D');
        $this->addSql('DROP INDEX IDX_130D3BD31EC22D ON appel');
        $this->addSql('ALTER TABLE appel CHANGE speclialist_id specialist_id INT NOT NULL');
        $this->addSql('ALTER TABLE appel ADD CONSTRAINT FK_130D3BD7B100C1A FOREIGN KEY (specialist_id) REFERENCES specialist (id)');
        $this->addSql('CREATE INDEX IDX_130D3BD7B100C1A ON appel (specialist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel DROP FOREIGN KEY FK_130D3BD7B100C1A');
        $this->addSql('DROP INDEX IDX_130D3BD7B100C1A ON appel');
        $this->addSql('ALTER TABLE appel CHANGE specialist_id speclialist_id INT NOT NULL');
        $this->addSql('ALTER TABLE appel ADD CONSTRAINT FK_130D3BD31EC22D FOREIGN KEY (speclialist_id) REFERENCES specialist (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_130D3BD31EC22D ON appel (speclialist_id)');
    }
}
