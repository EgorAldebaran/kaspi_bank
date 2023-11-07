<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107205402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, employee_id INT DEFAULT NULL, open_date DATE NOT NULL, close_date DATE DEFAULT NULL, last_activity DATE DEFAULT NULL, status VARCHAR(10) DEFAULT NULL, avail_balance DOUBLE PRECISION DEFAULT NULL, pending_balance DOUBLE PRECISION DEFAULT NULL, INDEX IDX_7D3656A44584665A (product_id), INDEX IDX_7D3656A49395C3F3 (customer_id), INDEX IDX_7D3656A48C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bio (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, fname VARCHAR(255) NOT NULL, lname VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, UNIQUE INDEX UNIQ_DD206A7B9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE branch (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, cust_type VARCHAR(2) NOT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, fed_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, department_id INT DEFAULT NULL, branch_id INT DEFAULT NULL, fname VARCHAR(255) NOT NULL, lname VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, superior_emp INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_5D9F75A1AE80F5DF (department_id), INDEX IDX_5D9F75A1DCD6CC49 (branch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_offered DATE DEFAULT NULL, date_retired DATE DEFAULT NULL, INDEX IDX_D34A04AD14959723 (product_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A44584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A49395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A48C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE bio ADD CONSTRAINT FK_DD206A7B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1DCD6CC49 FOREIGN KEY (branch_id) REFERENCES branch (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD14959723 FOREIGN KEY (product_type_id) REFERENCES product_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A44584665A');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A49395C3F3');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A48C03F15C');
        $this->addSql('ALTER TABLE bio DROP FOREIGN KEY FK_DD206A7B9395C3F3');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1AE80F5DF');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1DCD6CC49');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD14959723');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE bio');
        $this->addSql('DROP TABLE branch');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_type');
    }
}
