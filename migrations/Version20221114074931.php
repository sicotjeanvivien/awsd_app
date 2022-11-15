<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114074931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, github VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE games_chuck_norris_fact CHANGE liked liked INT DEFAULT NULL, CHANGE disliked disliked INT DEFAULT NULL, CHANGE is_valided is_valided TINYINT(1) DEFAULT NULL, CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_artist CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_card CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_color CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_mana_cost CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_rarity CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_set CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_subtype CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_supertype CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_type CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE organisator_task CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE tchat_conversation CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE tchat_message CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE user CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE project');
        $this->addSql('ALTER TABLE games_chuck_norris_fact CHANGE liked liked INT DEFAULT 0, CHANGE disliked disliked INT DEFAULT 0, CHANGE is_valided is_valided TINYINT(1) DEFAULT 0, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_artist CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_card CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_color CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_mana_cost CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_rarity CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_set CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_subtype CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_supertype CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_type CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE organisator_task CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE tchat_conversation CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE tchat_message CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE updated updated DATETIME DEFAULT NULL');
    }
}
