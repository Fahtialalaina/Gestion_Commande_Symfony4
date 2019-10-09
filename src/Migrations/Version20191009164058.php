<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191009164058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_client_id INT NOT NULL, date_com DATETIME NOT NULL, INDEX IDX_6EEAA67D99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD id_com_id INT NOT NULL, CHANGE id_produit_id id_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B52BBBADA FOREIGN KEY (id_com_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B52BBBADA ON ligne_commande (id_com_id)');
        $this->addSql('ALTER TABLE produit CHANGE id_categorie_id id_categorie_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B52BBBADA');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP INDEX IDX_3170B74B52BBBADA ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande DROP id_com_id, CHANGE id_produit_id id_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE id_categorie_id id_categorie_id INT DEFAULT NULL');
    }
}
