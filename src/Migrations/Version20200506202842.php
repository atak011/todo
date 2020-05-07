<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506202842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE log (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content VARCHAR(255) NOT NULL, level VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('DROP INDEX IDX_527EDB258642D293');
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, assigned_developer_id, name, time, difficulty FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, assigned_developer_id INTEGER DEFAULT NULL, name VARCHAR(100) NOT NULL COLLATE BINARY, time SMALLINT NOT NULL, difficulty SMALLINT NOT NULL, CONSTRAINT FK_527EDB258642D293 FOREIGN KEY (assigned_developer_id) REFERENCES developer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO task (id, assigned_developer_id, name, time, difficulty) SELECT id, assigned_developer_id, name, time, difficulty FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE INDEX IDX_527EDB258642D293 ON task (assigned_developer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE log');
        $this->addSql('DROP INDEX IDX_527EDB258642D293');
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, assigned_developer_id, name, time, difficulty FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, assigned_developer_id INTEGER DEFAULT NULL, name VARCHAR(100) NOT NULL, time SMALLINT NOT NULL, difficulty SMALLINT NOT NULL)');
        $this->addSql('INSERT INTO task (id, assigned_developer_id, name, time, difficulty) SELECT id, assigned_developer_id, name, time, difficulty FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE INDEX IDX_527EDB258642D293 ON task (assigned_developer_id)');
    }
}
