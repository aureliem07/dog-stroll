<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729100306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dog (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(100) NOT NULL, birth_year INT DEFAULT NULL, breed VARCHAR(100) DEFAULT NULL, sex VARCHAR(100) NOT NULL, bio LONGTEXT DEFAULT NULL, INDEX IDX_812C397DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stroll (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME DEFAULT NULL, starting_point VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, bio LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_stroll (user_id INT NOT NULL, stroll_id INT NOT NULL, INDEX IDX_5A856E2CA76ED395 (user_id), INDEX IDX_5A856E2C315AC68C (stroll_id), PRIMARY KEY(user_id, stroll_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_stroll ADD CONSTRAINT FK_5A856E2CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_stroll ADD CONSTRAINT FK_5A856E2C315AC68C FOREIGN KEY (stroll_id) REFERENCES stroll (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_stroll DROP FOREIGN KEY FK_5A856E2C315AC68C');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397DA76ED395');
        $this->addSql('ALTER TABLE user_stroll DROP FOREIGN KEY FK_5A856E2CA76ED395');
        $this->addSql('DROP TABLE dog');
        $this->addSql('DROP TABLE stroll');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_stroll');
    }
}
