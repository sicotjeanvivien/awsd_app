<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919083345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE organisator_task (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, organisator_task_id INT DEFAULT NULL, task VARCHAR(255) NOT NULL, week_number INT NOT NULL, description LONGTEXT DEFAULT NULL, making TINYINT(1) NOT NULL, date DATE DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME on update CURRENT_TIMESTAMP, INDEX IDX_A95403BFA76ED395 (user_id), INDEX IDX_A95403BFEF68BA9A (organisator_task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE organisator_task ADD CONSTRAINT FK_A95403BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE organisator_task ADD CONSTRAINT FK_A95403BFEF68BA9A FOREIGN KEY (organisator_task_id) REFERENCES organisator_task (id)');
        $this->addSql('ALTER TABLE mtg_artist CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_card CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_color CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_mana_cost CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_rarity CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_set CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_subtype CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_supertype CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE mtg_type CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE tchat_conversation CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE tchat_message CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE user CHANGE updated updated DATETIME on update CURRENT_TIMESTAMP');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organisator_task DROP FOREIGN KEY FK_A95403BFEF68BA9A');
        $this->addSql('DROP TABLE organisator_task');
        $this->addSql('ALTER TABLE mtg_artist CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_card CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_color CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_mana_cost CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_rarity CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_set CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_subtype CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_supertype CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mtg_type CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE tchat_conversation CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE tchat_message CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE updated updated DATETIME DEFAULT NULL');
    }
}
