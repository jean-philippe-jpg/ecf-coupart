<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231228135920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_recettes (user_id INT NOT NULL, recettes_id INT NOT NULL, INDEX IDX_BC5032CA76ED395 (user_id), INDEX IDX_BC5032C3E2ED6D6 (recettes_id), PRIMARY KEY(user_id, recettes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_recettes ADD CONSTRAINT FK_BC5032CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_recettes ADD CONSTRAINT FK_BC5032C3E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_recettes DROP FOREIGN KEY FK_BC5032CA76ED395');
        $this->addSql('ALTER TABLE user_recettes DROP FOREIGN KEY FK_BC5032C3E2ED6D6');
        $this->addSql('DROP TABLE user_recettes');
    }
}
