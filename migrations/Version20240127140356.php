<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127140356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergenes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allergenes_user (allergenes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AACA346EC21A0BEF (allergenes_id), INDEX IDX_AACA346EA76ED395 (user_id), PRIMARY KEY(allergenes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recettes_allergenes (recettes_id INT NOT NULL, allergenes_id INT NOT NULL, INDEX IDX_4AFE999E3E2ED6D6 (recettes_id), INDEX IDX_4AFE999EC21A0BEF (allergenes_id), PRIMARY KEY(recettes_id, allergenes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recettes_regimes (recettes_id INT NOT NULL, regimes_id INT NOT NULL, INDEX IDX_E28E04643E2ED6D6 (recettes_id), INDEX IDX_E28E0464C6F0AE45 (regimes_id), PRIMARY KEY(recettes_id, regimes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regimes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regimes_user (regimes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_589E3380C6F0AE45 (regimes_id), INDEX IDX_589E3380A76ED395 (user_id), PRIMARY KEY(regimes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allergenes_user ADD CONSTRAINT FK_AACA346EC21A0BEF FOREIGN KEY (allergenes_id) REFERENCES allergenes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergenes_user ADD CONSTRAINT FK_AACA346EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_allergenes ADD CONSTRAINT FK_4AFE999E3E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_allergenes ADD CONSTRAINT FK_4AFE999EC21A0BEF FOREIGN KEY (allergenes_id) REFERENCES allergenes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_regimes ADD CONSTRAINT FK_E28E04643E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recettes_regimes ADD CONSTRAINT FK_E28E0464C6F0AE45 FOREIGN KEY (regimes_id) REFERENCES regimes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE regimes_user ADD CONSTRAINT FK_589E3380C6F0AE45 FOREIGN KEY (regimes_id) REFERENCES regimes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE regimes_user ADD CONSTRAINT FK_589E3380A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergenes_user DROP FOREIGN KEY FK_AACA346EC21A0BEF');
        $this->addSql('ALTER TABLE allergenes_user DROP FOREIGN KEY FK_AACA346EA76ED395');
        $this->addSql('ALTER TABLE recettes_allergenes DROP FOREIGN KEY FK_4AFE999E3E2ED6D6');
        $this->addSql('ALTER TABLE recettes_allergenes DROP FOREIGN KEY FK_4AFE999EC21A0BEF');
        $this->addSql('ALTER TABLE recettes_regimes DROP FOREIGN KEY FK_E28E04643E2ED6D6');
        $this->addSql('ALTER TABLE recettes_regimes DROP FOREIGN KEY FK_E28E0464C6F0AE45');
        $this->addSql('ALTER TABLE regimes_user DROP FOREIGN KEY FK_589E3380C6F0AE45');
        $this->addSql('ALTER TABLE regimes_user DROP FOREIGN KEY FK_589E3380A76ED395');
        $this->addSql('DROP TABLE allergenes');
        $this->addSql('DROP TABLE allergenes_user');
        $this->addSql('DROP TABLE recettes_allergenes');
        $this->addSql('DROP TABLE recettes_regimes');
        $this->addSql('DROP TABLE regimes');
        $this->addSql('DROP TABLE regimes_user');
    }
}
