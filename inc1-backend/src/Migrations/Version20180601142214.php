<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180601142214 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pergunta (id INT AUTO_INCREMENT NOT NULL, questionario_id INT DEFAULT NULL, resposta_id INT DEFAULT NULL, descricao VARCHAR(255) NOT NULL, pontuacao INT NOT NULL, dica VARCHAR(255) NOT NULL, INDEX IDX_124A7194664E1225 (questionario_id), INDEX IDX_124A719479F97242 (resposta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pergunta_resposta (id INT AUTO_INCREMENT NOT NULL, pergunta_id INT NOT NULL, resposta_id INT NOT NULL, letra VARCHAR(10) NOT NULL, INDEX IDX_158F27FD3C763537 (pergunta_id), INDEX IDX_158F27FD79F97242 (resposta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionario (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, pontuacao_total INT NOT NULL, tempo INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resposta (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tentativa (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, questionario_id INT NOT NULL, dica_acionada TINYINT(1) NOT NULL, eliminar_acionado TINYINT(1) NOT NULL, pular_acionado TINYINT(1) NOT NULL, dobrar_acionado TINYINT(1) NOT NULL, desafio_acionado TINYINT(1) NOT NULL, pontuacao INT NOT NULL, INDEX IDX_DCAE46E0A76ED395 (user_id), INDEX IDX_DCAE46E0664E1225 (questionario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tentativa_resposta (id INT AUTO_INCREMENT NOT NULL, tentativa_id INT NOT NULL, pergunta_id INT NOT NULL, resposta_id INT DEFAULT NULL, respondida TINYINT(1) NOT NULL, acertou TINYINT(1) NOT NULL, pulou TINYINT(1) NOT NULL, usou_dica TINYINT(1) NOT NULL, INDEX IDX_EBC5128058EE7320 (tentativa_id), INDEX IDX_EBC512803C763537 (pergunta_id), INDEX IDX_EBC5128079F97242 (resposta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pergunta ADD CONSTRAINT FK_124A7194664E1225 FOREIGN KEY (questionario_id) REFERENCES questionario (id)');
        $this->addSql('ALTER TABLE pergunta ADD CONSTRAINT FK_124A719479F97242 FOREIGN KEY (resposta_id) REFERENCES resposta (id)');
        $this->addSql('ALTER TABLE pergunta_resposta ADD CONSTRAINT FK_158F27FD3C763537 FOREIGN KEY (pergunta_id) REFERENCES pergunta (id)');
        $this->addSql('ALTER TABLE pergunta_resposta ADD CONSTRAINT FK_158F27FD79F97242 FOREIGN KEY (resposta_id) REFERENCES resposta (id)');
        $this->addSql('ALTER TABLE tentativa ADD CONSTRAINT FK_DCAE46E0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tentativa ADD CONSTRAINT FK_DCAE46E0664E1225 FOREIGN KEY (questionario_id) REFERENCES questionario (id)');
        $this->addSql('ALTER TABLE tentativa_resposta ADD CONSTRAINT FK_EBC5128058EE7320 FOREIGN KEY (tentativa_id) REFERENCES tentativa (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tentativa_resposta ADD CONSTRAINT FK_EBC512803C763537 FOREIGN KEY (pergunta_id) REFERENCES pergunta (id)');
        $this->addSql('ALTER TABLE tentativa_resposta ADD CONSTRAINT FK_EBC5128079F97242 FOREIGN KEY (resposta_id) REFERENCES resposta (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pergunta_resposta DROP FOREIGN KEY FK_158F27FD3C763537');
        $this->addSql('ALTER TABLE tentativa_resposta DROP FOREIGN KEY FK_EBC512803C763537');
        $this->addSql('ALTER TABLE pergunta DROP FOREIGN KEY FK_124A7194664E1225');
        $this->addSql('ALTER TABLE tentativa DROP FOREIGN KEY FK_DCAE46E0664E1225');
        $this->addSql('ALTER TABLE pergunta DROP FOREIGN KEY FK_124A719479F97242');
        $this->addSql('ALTER TABLE pergunta_resposta DROP FOREIGN KEY FK_158F27FD79F97242');
        $this->addSql('ALTER TABLE tentativa_resposta DROP FOREIGN KEY FK_EBC5128079F97242');
        $this->addSql('ALTER TABLE tentativa_resposta DROP FOREIGN KEY FK_EBC5128058EE7320');
        $this->addSql('ALTER TABLE tentativa DROP FOREIGN KEY FK_DCAE46E0A76ED395');
        $this->addSql('DROP TABLE pergunta');
        $this->addSql('DROP TABLE pergunta_resposta');
        $this->addSql('DROP TABLE questionario');
        $this->addSql('DROP TABLE resposta');
        $this->addSql('DROP TABLE tentativa');
        $this->addSql('DROP TABLE tentativa_resposta');
        $this->addSql('DROP TABLE user');
    }
}
