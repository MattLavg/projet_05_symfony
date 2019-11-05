<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191102141352 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(14) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE release_date (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, platform_id INT NOT NULL, region_id INT NOT NULL, publisher_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_E769876DE48FD905 (game_id), INDEX IDX_E769876DFFE6496F (platform_id), INDEX IDX_E769876D98260155 (region_id), INDEX IDX_E769876D40C86FCE (publisher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publisher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE release_date ADD CONSTRAINT FK_E769876DE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE release_date ADD CONSTRAINT FK_E769876DFFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE release_date ADD CONSTRAINT FK_E769876D98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE release_date ADD CONSTRAINT FK_E769876D40C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE release_date DROP FOREIGN KEY FK_E769876D98260155');
        $this->addSql('ALTER TABLE release_date DROP FOREIGN KEY FK_E769876DFFE6496F');
        $this->addSql('ALTER TABLE release_date DROP FOREIGN KEY FK_E769876D40C86FCE');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE release_date');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE publisher');
    }
}
