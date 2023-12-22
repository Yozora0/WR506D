<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207082025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_movie (category_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_F56DBD2612469DE2 (category_id), INDEX IDX_F56DBD268F93B6FC (movie_id), PRIMARY KEY(category_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_movie ADD CONSTRAINT FK_F56DBD2612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_movie ADD CONSTRAINT FK_F56DBD268F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor ADD reward LONGTEXT DEFAULT NULL, ADD nationality VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE movie ADD release_date DATETIME DEFAULT NULL, ADD description LONGTEXT NOT NULL, ADD duration INT DEFAULT NULL, ADD note DOUBLE PRECISION DEFAULT NULL, ADD entries INT DEFAULT NULL, ADD budget INT DEFAULT NULL, ADD director VARCHAR(255) NOT NULL, ADD website VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_movie DROP FOREIGN KEY FK_F56DBD2612469DE2');
        $this->addSql('ALTER TABLE category_movie DROP FOREIGN KEY FK_F56DBD268F93B6FC');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_movie');
        $this->addSql('ALTER TABLE actor DROP reward, DROP nationality');
        $this->addSql('ALTER TABLE movie DROP release_date, DROP description, DROP duration, DROP note, DROP entries, DROP budget, DROP director, DROP website');
        $this->addSql('ALTER TABLE `user` DROP username');
    }
}
