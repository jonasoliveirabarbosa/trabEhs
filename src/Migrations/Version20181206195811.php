<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181206195811 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE funcionario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, nome_usuario VARCHAR(255) NOT NULL, senha VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE exemplar (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, livro_id INTEGER NOT NULL, edicao VARCHAR(255) NOT NULL, ano INTEGER NOT NULL, ativo BOOLEAN NOT NULL, livre BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_F32A1AC15864C5AF ON exemplar (livro_id)');
        $this->addSql('CREATE TABLE cliente (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, ativo BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE emprestimo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cliente_id INTEGER NOT NULL, exemplar_id INTEGER NOT NULL, inicio DATETIME NOT NULL, fim DATETIME NOT NULL, ativo BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E6813B92DE734E51 ON emprestimo (cliente_id)');
        $this->addSql('CREATE INDEX IDX_E6813B929DBA0AB9 ON emprestimo (exemplar_id)');
        $this->addSql('CREATE TABLE livro (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, genero VARCHAR(255) NOT NULL, titulo VARCHAR(255) NOT NULL, editora VARCHAR(255) DEFAULT NULL, autor VARCHAR(255) DEFAULT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE exemplar');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE emprestimo');
        $this->addSql('DROP TABLE livro');
    }
}
