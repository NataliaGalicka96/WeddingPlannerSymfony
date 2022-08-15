<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220814125534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE podcategory_default (id INT AUTO_INCREMENT NOT NULL, category_name_id INT DEFAULT NULL, podcategory_name VARCHAR(255) NOT NULL, INDEX IDX_7BA27F54B6CFDCA8 (category_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_to_do (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(255) NOT NULL, task VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE podcategory_default ADD CONSTRAINT FK_7BA27F54B6CFDCA8 FOREIGN KEY (category_name_id) REFERENCES check_list_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE podcategory_default DROP FOREIGN KEY FK_7BA27F54B6CFDCA8');
        $this->addSql('DROP TABLE podcategory_default');
        $this->addSql('DROP TABLE task_to_do');
    }
}
