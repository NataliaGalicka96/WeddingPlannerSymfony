<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818101111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE budget DROP INDEX UNIQ_73F2F77BA76ED395, ADD INDEX IDX_73F2F77BA76ED395 (user_id)');
        $this->addSql('ALTER TABLE budget CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE expenses CHANGE already_paid already_paid DECIMAL(10,2) NULL DEFAULT "0.00"');
        $this->addSql('ALTER TABLE expenses CHANGE price price DECIMAL(10,2) NULL DEFAULT "0.00"');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE budget DROP INDEX IDX_73F2F77BA76ED395, ADD UNIQUE INDEX UNIQ_73F2F77BA76ED395 (user_id)');
        $this->addSql('ALTER TABLE budget CHANGE user_id user_id INT DEFAULT NULL');
    }
}
