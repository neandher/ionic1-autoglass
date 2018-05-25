<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180524141146 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tentativa (id INT AUTO_INCREMENT NOT NULL, tempo_inicio DATETIME NOT NULL, tempo_fim DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tentativa_resposta (id INT AUTO_INCREMENT NOT NULL, tentativa_id INT NOT NULL, pergunta_id INT NOT NULL, resposta_id INT NOT NULL, INDEX IDX_EBC5128058EE7320 (tentativa_id), INDEX IDX_EBC512803C763537 (pergunta_id), INDEX IDX_EBC5128079F97242 (resposta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tentativa_resposta ADD CONSTRAINT FK_EBC5128058EE7320 FOREIGN KEY (tentativa_id) REFERENCES tentativa (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tentativa_resposta ADD CONSTRAINT FK_EBC512803C763537 FOREIGN KEY (pergunta_id) REFERENCES pergunta (id)');
        $this->addSql('ALTER TABLE tentativa_resposta ADD CONSTRAINT FK_EBC5128079F97242 FOREIGN KEY (resposta_id) REFERENCES resposta (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tentativa_resposta DROP FOREIGN KEY FK_EBC5128058EE7320');
        $this->addSql('DROP TABLE tentativa');
        $this->addSql('DROP TABLE tentativa_resposta');
        $this->addSql('DROP TABLE user');
    }
}
