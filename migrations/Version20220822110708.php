<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220822110708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wedding_settings (id INT AUTO_INCREMENT NOT NULL, bride_name VARCHAR(255) NOT NULL, groom_name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expenses CHANGE price price NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, CHANGE already_paid already_paid NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE user ADD wedding_settings_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497A22435E FOREIGN KEY (wedding_settings_id) REFERENCES wedding_settings (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6497A22435E ON user (wedding_settings_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497A22435E');
        $this->addSql('DROP TABLE wedding_settings');
        $this->addSql('ALTER TABLE expenses CHANGE price price NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, CHANGE already_paid already_paid NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('DROP INDEX IDX_8D93D6497A22435E ON user');
        $this->addSql('ALTER TABLE user DROP wedding_settings_id');
    }
}
