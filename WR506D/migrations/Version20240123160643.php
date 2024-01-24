<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123160643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie ADD media_object_id INT DEFAULT NULL, CHANGE director director VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F64DE5A5 FOREIGN KEY (media_object_id) REFERENCES media_object (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F64DE5A5 ON movie (media_object_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F64DE5A5');
        $this->addSql('DROP INDEX IDX_1D5EF26F64DE5A5 ON movie');
        $this->addSql('ALTER TABLE movie DROP media_object_id, CHANGE director director VARCHAR(255) NOT NULL');
    }
}
