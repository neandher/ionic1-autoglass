<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180519233419 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pergunta (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pergunta_resposta (id INT AUTO_INCREMENT NOT NULL, pergunta_id INT NOT NULL, resposta_id INT NOT NULL, correta TINYINT(1) NOT NULL, INDEX IDX_158F27FD3C763537 (pergunta_id), INDEX IDX_158F27FD79F97242 (resposta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resposta (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pergunta_resposta ADD CONSTRAINT FK_158F27FD3C763537 FOREIGN KEY (pergunta_id) REFERENCES pergunta (id)');
        $this->addSql('ALTER TABLE pergunta_resposta ADD CONSTRAINT FK_158F27FD79F97242 FOREIGN KEY (resposta_id) REFERENCES resposta (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pergunta_resposta DROP FOREIGN KEY FK_158F27FD3C763537');
        $this->addSql('ALTER TABLE pergunta_resposta DROP FOREIGN KEY FK_158F27FD79F97242');
        $this->addSql('DROP TABLE pergunta');
        $this->addSql('DROP TABLE pergunta_resposta');
        $this->addSql('DROP TABLE resposta');
    }
}
