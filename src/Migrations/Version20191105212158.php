<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191105212158 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE update_by_member_game');
        $this->addSql('DROP TABLE update_by_member_game_developer');
        $this->addSql('DROP TABLE update_by_member_game_genre');
        $this->addSql('DROP TABLE update_by_member_game_mode');
        $this->addSql('DROP TABLE update_by_member_release_date');
        $this->addSql('ALTER TABLE mode_game ADD PRIMARY KEY (mode_id, game_id)');
        $this->addSql('ALTER TABLE genre_game ADD PRIMARY KEY (genre_id, game_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(14) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE update_by_member_game (id INT NOT NULL, name VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, cover_extension VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, updated_by_member TINYINT(1) DEFAULT NULL, to_validate TINYINT(1) DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE update_by_member_game_developer (developer_id INT NOT NULL, game_id INT NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE update_by_member_game_genre (genre_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_98C6E87C4296D31F (genre_id), INDEX IDX_98C6E87CE48FD905 (game_id), PRIMARY KEY(genre_id, game_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE update_by_member_game_mode (mode_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_DD0280DF77E5854A (mode_id), INDEX IDX_DD0280DFE48FD905 (game_id), PRIMARY KEY(mode_id, game_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE update_by_member_release_date (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, platform_id INT NOT NULL, region_id INT NOT NULL, publisher_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_E769876DFFE6496F (platform_id), INDEX IDX_E769876D40C86FCE (publisher_id), INDEX IDX_E769876DE48FD905 (game_id), INDEX IDX_E769876D98260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE genre_game DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE mode_game DROP PRIMARY KEY');
    }
}
