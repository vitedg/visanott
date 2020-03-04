<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303090209 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE droit_access (id INT AUTO_INCREMENT NOT NULL, droit_import TINYINT(1) NOT NULL, droit_admin TINYINT(1) NOT NULL, admin_national TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, droit_access_id INT NOT NULL, role_lib VARCHAR(255) NOT NULL, INDEX IDX_57698A6A27EF82A8 (droit_access_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A27EF82A8 FOREIGN KEY (droit_access_id) REFERENCES droit_access (id)');
        $this->addSql('ALTER TABLE fos_user ADD role_id INT NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_957A6479D60322AC ON fos_user (role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A27EF82A8');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479D60322AC');
        $this->addSql('DROP TABLE droit_access');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP INDEX IDX_957A6479D60322AC ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP role_id, DROP name, DROP last_name');
    }
}
