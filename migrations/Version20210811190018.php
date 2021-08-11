<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210811190018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stroll ADD created_by INT NOT NULL');
        $this->addSql('ALTER TABLE stroll ADD CONSTRAINT FK_3FD77511DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3FD77511DE12AB56 ON stroll (created_by)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stroll DROP FOREIGN KEY FK_3FD77511DE12AB56');
        $this->addSql('DROP INDEX IDX_3FD77511DE12AB56 ON stroll');
        $this->addSql('ALTER TABLE stroll DROP created_by');
    }
}
