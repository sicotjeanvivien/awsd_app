<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905114754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mtg_artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_card (id INT AUTO_INCREMENT NOT NULL, mtg_set_id INT DEFAULT NULL, mtg_rarity_id INT DEFAULT NULL, mtg_artist_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, number VARCHAR(10) DEFAULT NULL, power VARCHAR(10) DEFAULT NULL, toughness VARCHAR(10) DEFAULT NULL, multiverseid VARCHAR(20) DEFAULT NULL, foreign_texts LONGTEXT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, INDEX IDX_AE09BE0CC456E928 (mtg_set_id), INDEX IDX_AE09BE0C456A798A (mtg_rarity_id), INDEX IDX_AE09BE0C1890001 (mtg_artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_card_mtg_type (mtg_card_id INT NOT NULL, mtg_type_id INT NOT NULL, INDEX IDX_89C5365A6CC10768 (mtg_card_id), INDEX IDX_89C5365AE34111DB (mtg_type_id), PRIMARY KEY(mtg_card_id, mtg_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_card_mtg_subtype (mtg_card_id INT NOT NULL, mtg_subtype_id INT NOT NULL, INDEX IDX_F55F60A46CC10768 (mtg_card_id), INDEX IDX_F55F60A44AF970E8 (mtg_subtype_id), PRIMARY KEY(mtg_card_id, mtg_subtype_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_card_mtg_supertype (mtg_card_id INT NOT NULL, mtg_supertype_id INT NOT NULL, INDEX IDX_1A2B3BF6CC10768 (mtg_card_id), INDEX IDX_1A2B3BF1D33D52F (mtg_supertype_id), PRIMARY KEY(mtg_card_id, mtg_supertype_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_card_mtg_mana_cost (mtg_card_id INT NOT NULL, mtg_mana_cost_id INT NOT NULL, INDEX IDX_9C8898686CC10768 (mtg_card_id), INDEX IDX_9C889868383EC2B8 (mtg_mana_cost_id), PRIMARY KEY(mtg_card_id, mtg_mana_cost_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_color (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_mana_cost (id INT AUTO_INCREMENT NOT NULL, color_id INT DEFAULT NULL, cost INT NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, INDEX IDX_7A7A263C7ADA1FB5 (color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_rarity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_set (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(25) NOT NULL, name VARCHAR(150) NOT NULL, release_date DATE NOT NULL, online_only TINYINT(1) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_subtype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_supertype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtg_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tchat_conversation (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tchat_conversation_user (tchat_conversation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6344C05F1E59B9B9 (tchat_conversation_id), INDEX IDX_6344C05FA76ED395 (user_id), PRIMARY KEY(tchat_conversation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tchat_message (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, tchat_conversation_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, INDEX IDX_F45F6AE9A76ED395 (user_id), INDEX IDX_F45F6AE91E59B9B9 (tchat_conversation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, auth_token VARCHAR(255) DEFAULT NULL, auth_token_generation_date DATETIME DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mtg_card ADD CONSTRAINT FK_AE09BE0CC456E928 FOREIGN KEY (mtg_set_id) REFERENCES mtg_set (id)');
        $this->addSql('ALTER TABLE mtg_card ADD CONSTRAINT FK_AE09BE0C456A798A FOREIGN KEY (mtg_rarity_id) REFERENCES mtg_rarity (id)');
        $this->addSql('ALTER TABLE mtg_card ADD CONSTRAINT FK_AE09BE0C1890001 FOREIGN KEY (mtg_artist_id) REFERENCES mtg_artist (id)');
        $this->addSql('ALTER TABLE mtg_card_mtg_type ADD CONSTRAINT FK_89C5365A6CC10768 FOREIGN KEY (mtg_card_id) REFERENCES mtg_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_type ADD CONSTRAINT FK_89C5365AE34111DB FOREIGN KEY (mtg_type_id) REFERENCES mtg_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_subtype ADD CONSTRAINT FK_F55F60A46CC10768 FOREIGN KEY (mtg_card_id) REFERENCES mtg_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_subtype ADD CONSTRAINT FK_F55F60A44AF970E8 FOREIGN KEY (mtg_subtype_id) REFERENCES mtg_subtype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_supertype ADD CONSTRAINT FK_1A2B3BF6CC10768 FOREIGN KEY (mtg_card_id) REFERENCES mtg_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_supertype ADD CONSTRAINT FK_1A2B3BF1D33D52F FOREIGN KEY (mtg_supertype_id) REFERENCES mtg_supertype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_mana_cost ADD CONSTRAINT FK_9C8898686CC10768 FOREIGN KEY (mtg_card_id) REFERENCES mtg_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_card_mtg_mana_cost ADD CONSTRAINT FK_9C889868383EC2B8 FOREIGN KEY (mtg_mana_cost_id) REFERENCES mtg_mana_cost (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mtg_mana_cost ADD CONSTRAINT FK_7A7A263C7ADA1FB5 FOREIGN KEY (color_id) REFERENCES mtg_color (id)');
        $this->addSql('ALTER TABLE tchat_conversation_user ADD CONSTRAINT FK_6344C05F1E59B9B9 FOREIGN KEY (tchat_conversation_id) REFERENCES tchat_conversation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tchat_conversation_user ADD CONSTRAINT FK_6344C05FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tchat_message ADD CONSTRAINT FK_F45F6AE9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tchat_message ADD CONSTRAINT FK_F45F6AE91E59B9B9 FOREIGN KEY (tchat_conversation_id) REFERENCES tchat_conversation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mtg_card DROP FOREIGN KEY FK_AE09BE0C1890001');
        $this->addSql('ALTER TABLE mtg_card_mtg_type DROP FOREIGN KEY FK_89C5365A6CC10768');
        $this->addSql('ALTER TABLE mtg_card_mtg_subtype DROP FOREIGN KEY FK_F55F60A46CC10768');
        $this->addSql('ALTER TABLE mtg_card_mtg_supertype DROP FOREIGN KEY FK_1A2B3BF6CC10768');
        $this->addSql('ALTER TABLE mtg_card_mtg_mana_cost DROP FOREIGN KEY FK_9C8898686CC10768');
        $this->addSql('ALTER TABLE mtg_mana_cost DROP FOREIGN KEY FK_7A7A263C7ADA1FB5');
        $this->addSql('ALTER TABLE mtg_card_mtg_mana_cost DROP FOREIGN KEY FK_9C889868383EC2B8');
        $this->addSql('ALTER TABLE mtg_card DROP FOREIGN KEY FK_AE09BE0C456A798A');
        $this->addSql('ALTER TABLE mtg_card DROP FOREIGN KEY FK_AE09BE0CC456E928');
        $this->addSql('ALTER TABLE mtg_card_mtg_subtype DROP FOREIGN KEY FK_F55F60A44AF970E8');
        $this->addSql('ALTER TABLE mtg_card_mtg_supertype DROP FOREIGN KEY FK_1A2B3BF1D33D52F');
        $this->addSql('ALTER TABLE mtg_card_mtg_type DROP FOREIGN KEY FK_89C5365AE34111DB');
        $this->addSql('ALTER TABLE tchat_conversation_user DROP FOREIGN KEY FK_6344C05F1E59B9B9');
        $this->addSql('ALTER TABLE tchat_message DROP FOREIGN KEY FK_F45F6AE91E59B9B9');
        $this->addSql('ALTER TABLE tchat_conversation_user DROP FOREIGN KEY FK_6344C05FA76ED395');
        $this->addSql('ALTER TABLE tchat_message DROP FOREIGN KEY FK_F45F6AE9A76ED395');
        $this->addSql('DROP TABLE mtg_artist');
        $this->addSql('DROP TABLE mtg_card');
        $this->addSql('DROP TABLE mtg_card_mtg_type');
        $this->addSql('DROP TABLE mtg_card_mtg_subtype');
        $this->addSql('DROP TABLE mtg_card_mtg_supertype');
        $this->addSql('DROP TABLE mtg_card_mtg_mana_cost');
        $this->addSql('DROP TABLE mtg_color');
        $this->addSql('DROP TABLE mtg_mana_cost');
        $this->addSql('DROP TABLE mtg_rarity');
        $this->addSql('DROP TABLE mtg_set');
        $this->addSql('DROP TABLE mtg_subtype');
        $this->addSql('DROP TABLE mtg_supertype');
        $this->addSql('DROP TABLE mtg_type');
        $this->addSql('DROP TABLE tchat_conversation');
        $this->addSql('DROP TABLE tchat_conversation_user');
        $this->addSql('DROP TABLE tchat_message');
        $this->addSql('DROP TABLE user');
    }
}
