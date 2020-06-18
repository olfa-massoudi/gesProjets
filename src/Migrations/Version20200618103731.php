<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618103731 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe CHANGE description description VARCHAR(20) DEFAULT NULL, CHANGE membre1_id membre1_id INT DEFAULT NULL, CHANGE membre2_id membre2_id INT DEFAULT NULL, CHANGE membre3_id membre3_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15D6FF4263 FOREIGN KEY (responsalbe_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15400F1CEA FOREIGN KEY (membre1_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1552BAB304 FOREIGN KEY (membre2_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15EA06D461 FOREIGN KEY (membre3_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_2449BA15D6FF4263 ON equipe (responsalbe_id)');
        $this->addSql('CREATE INDEX IDX_2449BA15400F1CEA ON equipe (membre1_id)');
        $this->addSql('CREATE INDEX IDX_2449BA1552BAB304 ON equipe (membre2_id)');
        $this->addSql('CREATE INDEX IDX_2449BA15EA06D461 ON equipe (membre3_id)');
        $this->addSql('ALTER TABLE projet CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_938720754A8CA2AD ON tache');
        $this->addSql('ALTER TABLE tache ADD etat VARCHAR(100) DEFAULT NULL, DROP etape_id, CHANGE projet_id projet_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE search CHANGE filtre filtre VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE role role VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15D6FF4263');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15400F1CEA');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1552BAB304');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15EA06D461');
        $this->addSql('DROP INDEX IDX_2449BA15D6FF4263 ON equipe');
        $this->addSql('DROP INDEX IDX_2449BA15400F1CEA ON equipe');
        $this->addSql('DROP INDEX IDX_2449BA1552BAB304 ON equipe');
        $this->addSql('DROP INDEX IDX_2449BA15EA06D461 ON equipe');
        $this->addSql('ALTER TABLE equipe CHANGE membre1_id membre1_id INT DEFAULT NULL, CHANGE membre2_id membre2_id INT DEFAULT NULL, CHANGE membre3_id membre3_id INT DEFAULT NULL, CHANGE description description VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE projet CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE search CHANGE filtre filtre VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tache ADD etape_id INT DEFAULT NULL, DROP etat, CHANGE projet_id projet_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE INDEX IDX_938720754A8CA2AD ON tache (etape_id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE role role VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
