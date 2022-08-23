<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823052232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenses CHANGE price price NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, CHANGE already_paid already_paid NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497A22435E');
        $this->addSql('DROP INDEX IDX_8D93D6497A22435E ON user');
        $this->addSql('ALTER TABLE user DROP wedding_settings_id');
        $this->addSql('ALTER TABLE wedding_settings ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE wedding_settings ADD CONSTRAINT FK_4D484E0EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4D484E0EA76ED395 ON wedding_settings (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenses CHANGE price price NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, CHANGE already_paid already_paid NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE user ADD wedding_settings_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497A22435E FOREIGN KEY (wedding_settings_id) REFERENCES wedding_settings (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6497A22435E ON user (wedding_settings_id)');
        $this->addSql('ALTER TABLE wedding_settings DROP FOREIGN KEY FK_4D484E0EA76ED395');
        $this->addSql('DROP INDEX IDX_4D484E0EA76ED395 ON wedding_settings');
        $this->addSql('ALTER TABLE wedding_settings DROP user_id');
    }
}
