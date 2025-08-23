<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250823182448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starship_droid DROP CONSTRAINT FK_1C7FBE889B24DF5');
        $this->addSql('ALTER TABLE starship_droid DROP CONSTRAINT FK_1C7FBE88AB064EF');
        $this->addSql('ALTER TABLE starship_droid DROP CONSTRAINT starship_droid_pkey');
        $this->addSql('ALTER TABLE starship_droid ADD id SERIAL NOT NULL');
        $this->addSql('ALTER TABLE starship_droid ADD assigned_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NOW() NOT NULL');
        $this->addSql('COMMENT ON COLUMN starship_droid.assigned_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT FK_1C7FBE889B24DF5 FOREIGN KEY (starship_id) REFERENCES starship (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT FK_1C7FBE88AB064EF FOREIGN KEY (droid_id) REFERENCES droid (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE starship_droid ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE starship_droid DROP CONSTRAINT fk_1c7fbe88ab064ef');
        $this->addSql('ALTER TABLE starship_droid DROP CONSTRAINT fk_1c7fbe889b24df5');
        $this->addSql('DROP INDEX starship_droid_pkey');
        $this->addSql('ALTER TABLE starship_droid DROP id');
        $this->addSql('ALTER TABLE starship_droid DROP assigned_at');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT fk_1c7fbe88ab064ef FOREIGN KEY (droid_id) REFERENCES droid (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT fk_1c7fbe889b24df5 FOREIGN KEY (starship_id) REFERENCES starship (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE starship_droid ADD PRIMARY KEY (starship_id, droid_id)');
    }
}
