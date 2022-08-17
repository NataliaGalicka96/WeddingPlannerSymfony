<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816130211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE check_category_assigned_to_user DROP FOREIGN KEY FK_FED5FFB7A76ED395');
        $this->addSql('ALTER TABLE check_list_assigned_to_user DROP FOREIGN KEY FK_28FA237FA76ED395');
        $this->addSql('ALTER TABLE check_list_podcategory DROP FOREIGN KEY FK_7B2AD63212469DE2');
        $this->addSql('DROP TABLE check_category_assigned_to_user');
        $this->addSql('DROP TABLE check_list_assigned_to_user');
        $this->addSql('DROP TABLE check_list_podcategory');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE check_category_assigned_to_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_FED5FFB7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE check_list_assigned_to_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, category_id INT NOT NULL, INDEX IDX_28FA237FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE check_list_podcategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_7B2AD63212469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE check_category_assigned_to_user ADD CONSTRAINT FK_FED5FFB7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE check_list_assigned_to_user ADD CONSTRAINT FK_28FA237FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE check_list_podcategory ADD CONSTRAINT FK_7B2AD63212469DE2 FOREIGN KEY (category_id) REFERENCES check_list_category (id)');
    }
}
