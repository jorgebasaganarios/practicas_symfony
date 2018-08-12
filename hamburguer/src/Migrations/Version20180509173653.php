<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180509173653 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comanda (id INT AUTO_INCREMENT NOT NULL, estado LONGTEXT NOT NULL, mesa INT NOT NULL, camarero LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comanda_producto (comanda_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_72FF6ACE787958A8 (comanda_id), INDEX IDX_72FF6ACE7645698E (producto_id), PRIMARY KEY(comanda_id, producto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, nombre TINYTEXT NOT NULL, precio NUMERIC(10, 2) NOT NULL, tipo INT NOT NULL, descripcion LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comanda_producto ADD CONSTRAINT FK_72FF6ACE787958A8 FOREIGN KEY (comanda_id) REFERENCES comanda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comanda_producto ADD CONSTRAINT FK_72FF6ACE7645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comanda_producto DROP FOREIGN KEY FK_72FF6ACE787958A8');
        $this->addSql('ALTER TABLE comanda_producto DROP FOREIGN KEY FK_72FF6ACE7645698E');
        $this->addSql('DROP TABLE comanda');
        $this->addSql('DROP TABLE comanda_producto');
        $this->addSql('DROP TABLE producto');
    }
}
