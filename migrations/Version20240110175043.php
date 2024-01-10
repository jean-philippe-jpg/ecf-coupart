<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110175043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments_recettes ADD recettes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comments_recettes ADD CONSTRAINT FK_7997A0443E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id)');
        $this->addSql('CREATE INDEX IDX_7997A0443E2ED6D6 ON comments_recettes (recettes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments_recettes DROP FOREIGN KEY FK_7997A0443E2ED6D6');
        $this->addSql('DROP INDEX IDX_7997A0443E2ED6D6 ON comments_recettes');
        $this->addSql('ALTER TABLE comments_recettes DROP recettes_id');
    }
}
