<?php

namespace CPASimUSante\ItemSelectorBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/12/11 10:57:00
 */
class Version20151211105657 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE cpasimusante__itemselector (
                id INT AUTO_INCREMENT NOT NULL, 
                resource_id INT DEFAULT NULL, 
                title VARCHAR(255) NOT NULL, 
                resourceNode_id INT DEFAULT NULL, 
                INDEX IDX_F924AFCF89329D25 (resource_id), 
                UNIQUE INDEX UNIQ_F924AFCFB87FAB32 (resourceNode_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE cpasimusante__item (
                id INT AUTO_INCREMENT NOT NULL, 
                resource_node_id INT DEFAULT NULL, 
                itemselector_id INT DEFAULT NULL, 
                INDEX IDX_1C4361FA1BAD783F (resource_node_id), 
                INDEX IDX_1C4361FAAE96C331 (itemselector_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE cpasimusante__mainconfig (
                id INT AUTO_INCREMENT NOT NULL, 
                resourcetype_id INT DEFAULT NULL, 
                workspace_id INT DEFAULT NULL, 
                INDEX IDX_D1B74EAFF48381EA (resourcetype_id), 
                INDEX IDX_D1B74EAF82D40A1F (workspace_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE cpasimusante__itemselector 
            ADD CONSTRAINT FK_F924AFCF89329D25 FOREIGN KEY (resource_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE cpasimusante__itemselector 
            ADD CONSTRAINT FK_F924AFCFB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE cpasimusante__item 
            ADD CONSTRAINT FK_1C4361FA1BAD783F FOREIGN KEY (resource_node_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            ALTER TABLE cpasimusante__item 
            ADD CONSTRAINT FK_1C4361FAAE96C331 FOREIGN KEY (itemselector_id) 
            REFERENCES cpasimusante__itemselector (id)
        ");
        $this->addSql("
            ALTER TABLE cpasimusante__mainconfig 
            ADD CONSTRAINT FK_D1B74EAFF48381EA FOREIGN KEY (resourcetype_id) 
            REFERENCES claro_resource_type (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE cpasimusante__mainconfig 
            ADD CONSTRAINT FK_D1B74EAF82D40A1F FOREIGN KEY (workspace_id) 
            REFERENCES claro_workspace (id) 
            ON DELETE SET NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE cpasimusante__item 
            DROP FOREIGN KEY FK_1C4361FAAE96C331
        ");
        $this->addSql("
            DROP TABLE cpasimusante__itemselector
        ");
        $this->addSql("
            DROP TABLE cpasimusante__item
        ");
        $this->addSql("
            DROP TABLE cpasimusante__mainconfig
        ");
    }
}