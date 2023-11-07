<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231105230856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bio ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bio ADD CONSTRAINT FK_DD206A7B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DD206A7B9395C3F3 ON bio (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bio DROP FOREIGN KEY FK_DD206A7B9395C3F3');
        $this->addSql('DROP INDEX UNIQ_DD206A7B9395C3F3 ON bio');
        $this->addSql('ALTER TABLE bio DROP customer_id');
    }
}
