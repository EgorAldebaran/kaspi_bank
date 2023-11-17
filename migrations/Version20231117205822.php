<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117205822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, symbol VARCHAR(10) NOT NULL, asset_type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, cik INT NOT NULL, exchange VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, sector VARCHAR(255) NOT NULL, industry VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, fiscal_year_end VARCHAR(255) NOT NULL, latest_quarter DATETIME NOT NULL, market_capitalization INT NOT NULL, ebitda INT NOT NULL, peratio DOUBLE PRECISION NOT NULL, pegratio DOUBLE PRECISION NOT NULL, book_value DOUBLE PRECISION NOT NULL, dividend_per_share DOUBLE PRECISION NOT NULL, dividend_yield DOUBLE PRECISION NOT NULL, eps DOUBLE PRECISION NOT NULL, revenue_per_share_ttm DOUBLE PRECISION NOT NULL, profit_margin DOUBLE PRECISION NOT NULL, operating_margin_ttm DOUBLE PRECISION NOT NULL, return_on_assets_ttm DOUBLE PRECISION NOT NULL, return_on_equity_ttm DOUBLE PRECISION NOT NULL, revenue_ttm INT NOT NULL, gross_profit_ttm INT NOT NULL, diluted_epsttm DOUBLE PRECISION NOT NULL, quarterly_earnings_growth_yoy DOUBLE PRECISION NOT NULL, quarterly_revenue_growth_yoy DOUBLE PRECISION NOT NULL, analyst_target_price DOUBLE PRECISION NOT NULL, trailing_pe DOUBLE PRECISION NOT NULL, forward_pe DOUBLE PRECISION NOT NULL, price_to_sales_ratio_ttm DOUBLE PRECISION NOT NULL, price_to_book_ratio DOUBLE PRECISION NOT NULL, evto_revenue DOUBLE PRECISION NOT NULL, evto_ebitda DOUBLE PRECISION NOT NULL, beta DOUBLE PRECISION NOT NULL, w52_week_high DOUBLE PRECISION NOT NULL, w52_week_low DOUBLE PRECISION NOT NULL, m50_day_moving_average DOUBLE PRECISION NOT NULL, m200_day_moving_average DOUBLE PRECISION NOT NULL, shares_outstanding DOUBLE PRECISION NOT NULL, dividend_date DOUBLE PRECISION NOT NULL, ex_dividend_date DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE instrument');
    }
}
