<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180510140726 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE camarero (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comanda ADD camarero_id INT DEFAULT NULL, DROP camarero');
        $this->addSql('ALTER TABLE comanda ADD CONSTRAINT FK_45C50E547760FF7E FOREIGN KEY (camarero_id) REFERENCES camarero (id)');
        $this->addSql('CREATE INDEX IDX_45C50E547760FF7E ON comanda (camarero_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comanda DROP FOREIGN KEY FK_45C50E547760FF7E');
        $this->addSql('DROP TABLE camarero');
        $this->addSql('DROP INDEX IDX_45C50E547760FF7E ON comanda');
        $this->addSql('ALTER TABLE comanda ADD camarero LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, DROP camarero_id');
    }
}
