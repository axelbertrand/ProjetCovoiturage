<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191105185439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add preferences to user';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD can_smoke TINYINT(1) DEFAULT NULL, ADD can_access_driver_phone_number TINYINT(1) DEFAULT NULL, ADD can_access_driver_email TINYINT(1) DEFAULT NULL, ADD can_put_suitcase TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP can_smoke, DROP can_access_driver_phone_number, DROP can_access_driver_email, DROP can_put_suitcase');
    }
}
