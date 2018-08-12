<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180510173027 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mesa (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comanda ADD mesa_id INT DEFAULT NULL, DROP mesa');
        $this->addSql('ALTER TABLE comanda ADD CONSTRAINT FK_45C50E548BDC7AE9 FOREIGN KEY (mesa_id) REFERENCES mesa (id)');
        $this->addSql('CREATE INDEX IDX_45C50E548BDC7AE9 ON comanda (mesa_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comanda DROP FOREIGN KEY FK_45C50E548BDC7AE9');
        $this->addSql('DROP TABLE mesa');
        $this->addSql('DROP INDEX IDX_45C50E548BDC7AE9 ON comanda');
        $this->addSql('ALTER TABLE comanda ADD mesa INT NOT NULL, DROP mesa_id');
    }
}
