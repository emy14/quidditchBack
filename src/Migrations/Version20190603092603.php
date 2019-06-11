<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190603092603 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE oauth2_access_tokens (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D247A21B5F37A13B (token), INDEX IDX_D247A21B19EB6921 (client_id), INDEX IDX_D247A21B8D93D649 (user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth2_clients (id INT AUTO_INCREMENT NOT NULL, random_id VARCHAR(255) NOT NULL, redirect_uris LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', secret VARCHAR(255) NOT NULL, allowed_grant_types LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', type VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', idUtilisateur INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) DEFAULT NULL, last_name VARCHAR(100) DEFAULT NULL, deleted TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), INDEX search_idx_username (username), INDEX search_idx_email (email), PRIMARY KEY(idUtilisateur)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth2_refresh_tokens (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D394478C5F37A13B (token), INDEX IDX_D394478C19EB6921 (client_id), INDEX IDX_D394478C8D93D649 (user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE terrain (lieu INT DEFAULT NULL, idTerrain INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, INDEX IDX_C87653B12F577D59 (lieu), PRIMARY KEY(idTerrain)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classement (id_classement INT AUTO_INCREMENT NOT NULL, tournoi INT NOT NULL, equipe INT NOT NULL, score INT DEFAULT NULL, rang INT DEFAULT NULL, PRIMARY KEY(id_classement)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournoi (pays INT DEFAULT NULL, idTournoi INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, date_debut DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, INDEX IDX_18AFD9DF349F3CAE (pays), PRIMARY KEY(idTournoi)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (idNiveau INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(idNiveau)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (idRole INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(idRole)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (idEquipe INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(idEquipe)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id_joueur INT AUTO_INCREMENT NOT NULL, nationalite INT DEFAULT NULL, poste INT DEFAULT NULL, equipe INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, INDEX IDX_FD71A9C59EC4D73F (nationalite), INDEX IDX_FD71A9C57C890FAB (poste), INDEX IDX_FD71A9C52449BA15 (equipe), PRIMARY KEY(id_joueur)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth2_auth_codes (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user INT DEFAULT NULL, token VARCHAR(255) NOT NULL, redirect_uri LONGTEXT NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_A018A10D5F37A13B (token), INDEX IDX_A018A10D19EB6921 (client_id), INDEX IDX_A018A10D8D93D649 (user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (idPays INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(idPays)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_table (id_match INT AUTO_INCREMENT NOT NULL, arbitre INT DEFAULT NULL, niveau INT DEFAULT NULL, terrain INT DEFAULT NULL, tournoi INT DEFAULT NULL, score_premiere_equipe INT DEFAULT NULL, score_deuxieme_equipe INT DEFAULT NULL, temps INT DEFAULT NULL, date_debut DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, premiereEquipe INT DEFAULT NULL, deuxiemeEquipe INT DEFAULT NULL, INDEX IDX_4843F0E720B2E66E (arbitre), INDEX IDX_4843F0E74BDFF36B (niveau), INDEX IDX_4843F0E7C87653B1 (terrain), INDEX IDX_4843F0E75417C314 (premiereEquipe), INDEX IDX_4843F0E7945F7613 (deuxiemeEquipe), INDEX IDX_4843F0E718AFD9DF (tournoi), PRIMARY KEY(id_match)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (idPoste INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(idPoste)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oauth2_access_tokens ADD CONSTRAINT FK_D247A21B19EB6921 FOREIGN KEY (client_id) REFERENCES oauth2_clients (id)');
        $this->addSql('ALTER TABLE oauth2_access_tokens ADD CONSTRAINT FK_D247A21B8D93D649 FOREIGN KEY (user) REFERENCES user (idUtilisateur) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth2_refresh_tokens ADD CONSTRAINT FK_D394478C19EB6921 FOREIGN KEY (client_id) REFERENCES oauth2_clients (id)');
        $this->addSql('ALTER TABLE oauth2_refresh_tokens ADD CONSTRAINT FK_D394478C8D93D649 FOREIGN KEY (user) REFERENCES user (idUtilisateur) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE terrain ADD CONSTRAINT FK_C87653B12F577D59 FOREIGN KEY (lieu) REFERENCES pays (idPays) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DF349F3CAE FOREIGN KEY (pays) REFERENCES pays (idPays) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C59EC4D73F FOREIGN KEY (nationalite) REFERENCES pays (idPays) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C57C890FAB FOREIGN KEY (poste) REFERENCES poste (idPoste) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C52449BA15 FOREIGN KEY (equipe) REFERENCES equipe (idEquipe) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth2_auth_codes ADD CONSTRAINT FK_A018A10D19EB6921 FOREIGN KEY (client_id) REFERENCES oauth2_clients (id)');
        $this->addSql('ALTER TABLE oauth2_auth_codes ADD CONSTRAINT FK_A018A10D8D93D649 FOREIGN KEY (user) REFERENCES user (idUtilisateur) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_table ADD CONSTRAINT FK_4843F0E720B2E66E FOREIGN KEY (arbitre) REFERENCES user (idUtilisateur) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_table ADD CONSTRAINT FK_4843F0E74BDFF36B FOREIGN KEY (niveau) REFERENCES niveau (idNiveau) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_table ADD CONSTRAINT FK_4843F0E7C87653B1 FOREIGN KEY (terrain) REFERENCES terrain (idTerrain) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_table ADD CONSTRAINT FK_4843F0E75417C314 FOREIGN KEY (premiereEquipe) REFERENCES equipe (idEquipe) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_table ADD CONSTRAINT FK_4843F0E7945F7613 FOREIGN KEY (deuxiemeEquipe) REFERENCES equipe (idEquipe) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_table ADD CONSTRAINT FK_4843F0E718AFD9DF FOREIGN KEY (tournoi) REFERENCES tournoi (idTournoi) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oauth2_access_tokens DROP FOREIGN KEY FK_D247A21B19EB6921');
        $this->addSql('ALTER TABLE oauth2_refresh_tokens DROP FOREIGN KEY FK_D394478C19EB6921');
        $this->addSql('ALTER TABLE oauth2_auth_codes DROP FOREIGN KEY FK_A018A10D19EB6921');
        $this->addSql('ALTER TABLE oauth2_access_tokens DROP FOREIGN KEY FK_D247A21B8D93D649');
        $this->addSql('ALTER TABLE oauth2_refresh_tokens DROP FOREIGN KEY FK_D394478C8D93D649');
        $this->addSql('ALTER TABLE oauth2_auth_codes DROP FOREIGN KEY FK_A018A10D8D93D649');
        $this->addSql('ALTER TABLE match_table DROP FOREIGN KEY FK_4843F0E720B2E66E');
        $this->addSql('ALTER TABLE match_table DROP FOREIGN KEY FK_4843F0E7C87653B1');
        $this->addSql('ALTER TABLE match_table DROP FOREIGN KEY FK_4843F0E718AFD9DF');
        $this->addSql('ALTER TABLE match_table DROP FOREIGN KEY FK_4843F0E74BDFF36B');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C52449BA15');
        $this->addSql('ALTER TABLE match_table DROP FOREIGN KEY FK_4843F0E75417C314');
        $this->addSql('ALTER TABLE match_table DROP FOREIGN KEY FK_4843F0E7945F7613');
        $this->addSql('ALTER TABLE terrain DROP FOREIGN KEY FK_C87653B12F577D59');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DF349F3CAE');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C59EC4D73F');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C57C890FAB');
        $this->addSql('DROP TABLE oauth2_access_tokens');
        $this->addSql('DROP TABLE oauth2_clients');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE oauth2_refresh_tokens');
        $this->addSql('DROP TABLE terrain');
        $this->addSql('DROP TABLE classement');
        $this->addSql('DROP TABLE tournoi');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE oauth2_auth_codes');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE match_table');
        $this->addSql('DROP TABLE poste');
    }
}
