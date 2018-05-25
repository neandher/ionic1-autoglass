<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180524173430 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tentativa ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE tentativa ADD CONSTRAINT FK_DCAE46E0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DCAE46E0A76ED395 ON tentativa (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tentativa DROP FOREIGN KEY FK_DCAE46E0A76ED395');
        $this->addSql('DROP INDEX IDX_DCAE46E0A76ED395 ON tentativa');
        $this->addSql('ALTER TABLE tentativa DROP user_id');
    }
}
