<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303105741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, direction_id INT DEFAULT NULL, agence_code VARCHAR(3) NOT NULL, agence_lib VARCHAR(255) NOT NULL, INDEX IDX_64C19AA9AF73D997 (direction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction (id INT AUTO_INCREMENT NOT NULL, direction_code VARCHAR(2) NOT NULL, direction_lib VARCHAR(3) NOT NULL, oz VARCHAR(2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, profil_parent_id INT DEFAULT NULL, profil_lib VARCHAR(255) NOT NULL, INDEX IDX_E6D6B297DA01FC50 (profil_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil_agence (profil_id INT NOT NULL, agence_id INT NOT NULL, INDEX IDX_153E13FB275ED078 (profil_id), INDEX IDX_153E13FBD725330D (agence_id), PRIMARY KEY(profil_id, agence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil_type_anomalies (profil_id INT NOT NULL, type_anomalies_id INT NOT NULL, INDEX IDX_7CFB32FC275ED078 (profil_id), INDEX IDX_7CFB32FCEF7EB76 (type_anomalies_id), PRIMARY KEY(profil_id, type_anomalies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_anomalies (id INT AUTO_INCREMENT NOT NULL, anomalie_lib VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297DA01FC50 FOREIGN KEY (profil_parent_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE profil_agence ADD CONSTRAINT FK_153E13FB275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_agence ADD CONSTRAINT FK_153E13FBD725330D FOREIGN KEY (agence_id) REFERENCES agence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_type_anomalies ADD CONSTRAINT FK_7CFB32FC275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_type_anomalies ADD CONSTRAINT FK_7CFB32FCEF7EB76 FOREIGN KEY (type_anomalies_id) REFERENCES type_anomalies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE droit_access ADD admin_national TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD profil_id INT NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('CREATE INDEX IDX_957A6479D60322AC ON fos_user (role_id)');
        $this->addSql('CREATE INDEX IDX_957A6479275ED078 ON fos_user (profil_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profil_agence DROP FOREIGN KEY FK_153E13FBD725330D');
        $this->addSql('ALTER TABLE agence DROP FOREIGN KEY FK_64C19AA9AF73D997');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297DA01FC50');
        $this->addSql('ALTER TABLE profil_agence DROP FOREIGN KEY FK_153E13FB275ED078');
        $this->addSql('ALTER TABLE profil_type_anomalies DROP FOREIGN KEY FK_7CFB32FC275ED078');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479275ED078');
        $this->addSql('ALTER TABLE profil_type_anomalies DROP FOREIGN KEY FK_7CFB32FCEF7EB76');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE direction');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE profil_agence');
        $this->addSql('DROP TABLE profil_type_anomalies');
        $this->addSql('DROP TABLE type_anomalies');
        $this->addSql('ALTER TABLE droit_access DROP admin_national');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479D60322AC');
        $this->addSql('DROP INDEX IDX_957A6479D60322AC ON fos_user');
        $this->addSql('DROP INDEX IDX_957A6479275ED078 ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP profil_id');
    }
}
