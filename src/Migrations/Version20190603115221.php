<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190603115221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tournoi ADD createdBy INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DFD3564642 FOREIGN KEY (createdBy) REFERENCES user (idUtilisateur) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_18AFD9DFD3564642 ON tournoi (createdBy)');
        $this->addSql('ALTER TABLE joueur ADD league INT DEFAULT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C53EB4C318 FOREIGN KEY (league) REFERENCES niveau (idNiveau) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_FD71A9C53EB4C318 ON joueur (league)');
        $this->addSql('ALTER TABLE match_table ADD createdBy INT DEFAULT NULL');
        $this->addSql('ALTER TABLE match_table ADD CONSTRAINT FK_4843F0E7D3564642 FOREIGN KEY (createdBy) REFERENCES user (idUtilisateur) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4843F0E7D3564642 ON match_table (createdBy)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C53EB4C318');
        $this->addSql('DROP INDEX IDX_FD71A9C53EB4C318 ON joueur');
        $this->addSql('ALTER TABLE joueur DROP league');
        $this->addSql('ALTER TABLE match_table DROP FOREIGN KEY FK_4843F0E7D3564642');
        $this->addSql('DROP INDEX IDX_4843F0E7D3564642 ON match_table');
        $this->addSql('ALTER TABLE match_table DROP createdBy');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DFD3564642');
        $this->addSql('DROP INDEX IDX_18AFD9DFD3564642 ON tournoi');
        $this->addSql('ALTER TABLE tournoi DROP createdBy');
    }
}
