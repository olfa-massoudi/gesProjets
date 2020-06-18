<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200613091515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720754A8CA2AD');
        $this->addSql('CREATE TABLE commantaire (id INT AUTO_INCREMENT NOT NULL, tache_id INT NOT NULL, date_comm DATETIME NOT NULL, utlisateur VARCHAR(20) NOT NULL, INDEX IDX_93BF4CAFD2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commantaire ADD CONSTRAINT FK_93BF4CAFD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('DROP TABLE etape');
        $this->addSql('ALTER TABLE equipe ADD responsalbe_id INT NOT NULL, ADD membre1_id INT DEFAULT NULL, ADD membre2_id INT DEFAULT NULL, ADD membre3_id INT DEFAULT NULL, DROP nb_equipe, CHANGE description description VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15D6FF4263 FOREIGN KEY (responsalbe_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15400F1CEA FOREIGN KEY (membre1_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1552BAB304 FOREIGN KEY (membre2_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15EA06D461 FOREIGN KEY (membre3_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_2449BA15D6FF4263 ON equipe (responsalbe_id)');
        $this->addSql('CREATE INDEX IDX_2449BA15400F1CEA ON equipe (membre1_id)');
        $this->addSql('CREATE INDEX IDX_2449BA1552BAB304 ON equipe (membre2_id)');
        $this->addSql('CREATE INDEX IDX_2449BA15EA06D461 ON equipe (membre3_id)');
        $this->addSql('ALTER TABLE projet CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE search CHANGE filtre filtre VARCHAR(100) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_938720754A8CA2AD ON tache');
        $this->addSql('ALTER TABLE tache ADD etat VARCHAR(100) DEFAULT NULL, DROP etape_id, CHANGE projet_id projet_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE role role VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, description VARCHAR(250) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE commantaire');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15D6FF4263');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15400F1CEA');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1552BAB304');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15EA06D461');
        $this->addSql('DROP INDEX IDX_2449BA15D6FF4263 ON equipe');
        $this->addSql('DROP INDEX IDX_2449BA15400F1CEA ON equipe');
        $this->addSql('DROP INDEX IDX_2449BA1552BAB304 ON equipe');
        $this->addSql('DROP INDEX IDX_2449BA15EA06D461 ON equipe');
        $this->addSql('ALTER TABLE equipe ADD nb_equipe INT DEFAULT NULL, DROP responsalbe_id, DROP membre1_id, DROP membre2_id, DROP membre3_id, CHANGE description description VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE projet CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE search CHANGE filtre filtre VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tache ADD etape_id INT DEFAULT NULL, DROP etat, CHANGE projet_id projet_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720754A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id)');
        $this->addSql('CREATE INDEX IDX_938720754A8CA2AD ON tache (etape_id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE role role VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
