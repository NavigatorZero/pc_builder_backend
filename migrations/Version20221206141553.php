<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221206141553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('
    CREATE TABLE "user" 
        (
            id INT NOT NULL, 
            google_id INT DEFAULT NULL, 
            name VARCHAR(255) DEFAULT NULL, 
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            profile_image TEXT DEFAULT NULL, 
            PRIMARY KEY(id),
            UNIQUE (email)
        )
'
        );

        $this->addSql(
            '
        CREATE TABLE public.role
        (
            name VARCHAR NOT NULL,
            id   INTEGER NOT NULL
                CONSTRAINT id
                    primary key
        );
        '
        );

        $this->addSql(
            '
        CREATE TABLE public.user_role
        (
            role_id INTEGER not null,
            user_id INTEGER not null,
            constraint role_user___fk
                FOREIGN KEY (role_id) REFERENCES public.role (id),
            constraint user_role___fk
                FOREIGN KEY key (user_id) REFERENCES public."user" (id)
        );
        '
        );

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "user_role" DROP CONSTRAINT user_role___fk;');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT role_user___fk;');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE "role"');
        $this->addSql('DROP TABLE "user_role"');
    }
}
