<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191009165719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande ADD ref VARCHAR(15) NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande CHANGE id_produit_id id_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE id_categorie_id id_categorie_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande DROP ref');
        $this->addSql('ALTER TABLE ligne_commande CHANGE id_produit_id id_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE id_categorie_id id_categorie_id INT DEFAULT NULL');
    }
}
