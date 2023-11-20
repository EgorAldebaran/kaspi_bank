<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119220457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE terminal (id INT AUTO_INCREMENT NOT NULL, trader_id INT DEFAULT NULL, pos_entry DOUBLE PRECISION DEFAULT NULL, pos_close DOUBLE PRECISION DEFAULT NULL, trading_result DOUBLE PRECISION DEFAULT NULL, INDEX IDX_8F7B15411273968F (trader_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE terminal ADD CONSTRAINT FK_8F7B15411273968F FOREIGN KEY (trader_id) REFERENCES trader (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE terminal DROP FOREIGN KEY FK_8F7B15411273968F');
        $this->addSql('DROP TABLE terminal');
    }
}
