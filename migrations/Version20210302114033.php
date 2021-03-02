<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302114033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE peinture_categorie (peinture_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_38CEF7CFC2E869AB (peinture_id), INDEX IDX_38CEF7CFBCF5E72D (categorie_id), PRIMARY KEY(peinture_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE peinture_categorie ADD CONSTRAINT FK_38CEF7CFC2E869AB FOREIGN KEY (peinture_id) REFERENCES peinture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE peinture_categorie ADD CONSTRAINT FK_38CEF7CFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE peinture ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE peinture ADD CONSTRAINT FK_8FB3A9D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8FB3A9D6A76ED395 ON peinture (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE peinture_categorie');
        $this->addSql('ALTER TABLE peinture DROP FOREIGN KEY FK_8FB3A9D6A76ED395');
        $this->addSql('DROP INDEX IDX_8FB3A9D6A76ED395 ON peinture');
        $this->addSql('ALTER TABLE peinture DROP user_id');
    }
}
