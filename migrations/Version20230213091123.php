<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213091123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
    //     $this->addSql('ALTER TABLE user ADD society_name VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL');
    //     $this->addSql('ALTER TABLE voiture CHANGE annee annee DATE DEFAULT NULL');
    //     $this->addSql('CREATE UNIQUE INDEX UNIQ_E9E2810F5F1BBC4B ON voiture (plaque)');
     }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP society_name, DROP ville');
        $this->addSql('DROP INDEX UNIQ_E9E2810F5F1BBC4B ON voiture');
        $this->addSql('ALTER TABLE voiture CHANGE annee annee DATETIME DEFAULT NULL');
    }
}
