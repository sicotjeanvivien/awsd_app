<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817074829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mtg_card (id INT AUTO_INCREMENT NOT NULL, mtg_set_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, INDEX IDX_AE09BE0CC456E928 (mtg_set_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_card_mtg_type (mtg_card_id INT NOT NULL, mtg_type_id INT NOT NULL, INDEX IDX_89C5365A6CC10768 (mtg_card_id), INDEX IDX_89C5365AE34111DB (mtg_type_id), PRIMARY KEY(mtg_card_id, mtg_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_card_mtg_color (mtg_card_id INT NOT NULL, mtg_color_id INT NOT NULL, INDEX IDX_AF5F730E6CC10768 (mtg_card_id), INDEX IDX_AF5F730E2FBDB8A (mtg_color_id), PRIMARY KEY(mtg_card_id, mtg_color_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_card_mtg_subtype (mtg_card_id INT NOT NULL, mtg_subtype_id INT NOT NULL, INDEX IDX_F55F60A46CC10768 (mtg_card_id), INDEX IDX_F55F60A44AF970E8 (mtg_subtype_id), PRIMARY KEY(mtg_card_id, mtg_subtype_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_card_mtg_supertype (mtg_card_id INT NOT NULL, mtg_supertype_id INT NOT NULL, INDEX IDX_1A2B3BF6CC10768 (mtg_card_id), INDEX IDX_1A2B3BF1D33D52F (mtg_supertype_id), PRIMARY KEY(mtg_card_id, mtg_supertype_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_color (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_set (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(25) NOT NULL, name VARCHAR(150) NOT NULL, release_date DATE NOT NULL, online_only TINYINT(1) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_subtype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_supertype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mtg_card ADD CONSTRAINT FK_AE09BE0CC456E928 FOREIGN KEY (mtg_set_id) REFERENCES mtg_set (id)');
        $this->addSql('ALTER TABLE mtg_card_mtg_type ADD CONSTRAINT FK_89C5365A6CC10768 FOREIGN KEY (mtg_card_id) REFERENCES mtg_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_type ADD CONSTRAINT FK_89C5365AE34111DB FOREIGN KEY (mtg_type_id) REFERENCES mtg_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_color ADD CONSTRAINT FK_AF5F730E6CC10768 FOREIGN KEY (mtg_card_id) REFERENCES mtg_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_color ADD CONSTRAINT FK_AF5F730E2FBDB8A FOREIGN KEY (mtg_color_id) REFERENCES mtg_color (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_subtype ADD CONSTRAINT FK_F55F60A46CC10768 FOREIGN KEY (mtg_card_id) REFERENCES mtg_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_subtype ADD CONSTRAINT FK_F55F60A44AF970E8 FOREIGN KEY (mtg_subtype_id) REFERENCES mtg_subtype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_supertype ADD CONSTRAINT FK_1A2B3BF6CC10768 FOREIGN KEY (mtg_card_id) REFERENCES mtg_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_supertype ADD CONSTRAINT FK_1A2B3BF1D33D52F FOREIGN KEY (mtg_supertype_id) REFERENCES mtg_supertype (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mtg_card_mtg_type DROP FOREIGN KEY FK_89C5365A6CC10768');
        $this->addSql('ALTER TABLE mtg_card_mtg_color DROP FOREIGN KEY FK_AF5F730E6CC10768');
        $this->addSql('ALTER TABLE mtg_card_mtg_subtype DROP FOREIGN KEY FK_F55F60A46CC10768');
        $this->addSql('ALTER TABLE mtg_card_mtg_supertype DROP FOREIGN KEY FK_1A2B3BF6CC10768');
        $this->addSql('ALTER TABLE mtg_card_mtg_color DROP FOREIGN KEY FK_AF5F730E2FBDB8A');
        $this->addSql('ALTER TABLE mtg_card DROP FOREIGN KEY FK_AE09BE0CC456E928');
        $this->addSql('ALTER TABLE mtg_card_mtg_subtype DROP FOREIGN KEY FK_F55F60A44AF970E8');
        $this->addSql('ALTER TABLE mtg_card_mtg_supertype DROP FOREIGN KEY FK_1A2B3BF1D33D52F');
        $this->addSql('ALTER TABLE mtg_card_mtg_type DROP FOREIGN KEY FK_89C5365AE34111DB');
        $this->addSql('DROP TABLE mtg_card');
        $this->addSql('DROP TABLE mtg_card_mtg_type');
        $this->addSql('DROP TABLE mtg_card_mtg_color');
        $this->addSql('DROP TABLE mtg_card_mtg_subtype');
        $this->addSql('DROP TABLE mtg_card_mtg_supertype');
        $this->addSql('DROP TABLE mtg_color');
        $this->addSql('DROP TABLE mtg_set');
        $this->addSql('DROP TABLE mtg_subtype');
        $this->addSql('DROP TABLE mtg_supertype');
        $this->addSql('DROP TABLE mtg_type');
    }
}
