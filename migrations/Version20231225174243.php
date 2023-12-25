<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231225174243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recettes ADD patients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recettes ADD CONSTRAINT FK_EB48E72CCEC3FD2F FOREIGN KEY (patients_id) REFERENCES patients (id)');
        $this->addSql('CREATE INDEX IDX_EB48E72CCEC3FD2F ON recettes (patients_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recettes DROP FOREIGN KEY FK_EB48E72CCEC3FD2F');
        $this->addSql('DROP INDEX IDX_EB48E72CCEC3FD2F ON recettes');
        $this->addSql('ALTER TABLE recettes DROP patients_id');
    }
}
