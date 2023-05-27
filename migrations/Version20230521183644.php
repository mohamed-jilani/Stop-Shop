<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230521183644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP INDEX IDX_BA388B79D86650F, ADD UNIQUE INDEX UNIQ_BA388B79D86650F (user_id_id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD1AD5CDBF ON product (cart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP INDEX UNIQ_BA388B79D86650F, ADD INDEX IDX_BA388B79D86650F (user_id_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1AD5CDBF');
        $this->addSql('DROP INDEX IDX_D34A04AD1AD5CDBF ON product');
    }
}
