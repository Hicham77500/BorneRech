<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307142458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD COLUMN firstname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN street VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN postalcode VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN numtel VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN carbrand VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, password, roles, lastname FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , lastname VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO "user" (id, email, password, roles, lastname) SELECT id, email, password, roles, lastname FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
    }
}
