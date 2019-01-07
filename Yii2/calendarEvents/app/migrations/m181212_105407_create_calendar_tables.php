<?php

use yii\db\Migration;

/**
 * Class m181212_105407_create_calendar_tables
 */
class m181212_105407_create_calendar_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // создаём таблицу событий
        $this->createTable('events', [
            'id_events' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'startDay' => $this->timestamp()->defaultExpression("now()"),
            'endDay' => $this->timestamp()->defaultExpression("now()"),
            'id_user' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'isBlock' => $this->boolean()->defaultExpression("false"),
            'created_at' => $this->timestamp()->defaultExpression("now()")->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression("now()")->notNull()
        ]);

        // создаём таблицу пользователей
        $this->createTable('user', [
            'id_user' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultExpression("now()")->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression("now()")->notNull()
        ]);

        //создаём таблицу связки пользователей и событий
        $this->createTable('events_user', [
            'id_events_user' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_event' => $this->integer()
        ]);
        
        // создаём внешний ключ для поля id_user в таблице events
        $this->addForeignKey('foreign_key_events', 'events', 'id_user', 'user', 'id_user', 'cascade');
        // создаём внешний ключ для поля id_user в таблице events_user
        $this->addForeignKey('foreign_key_events_user1', 'events_user', 'id_user', 'user', 'id_user', 'cascade');
        // создаём внешний ключ для поля id_event в таблице events_user
        $this->addForeignKey('foreign_key_events_user2', 'events_user', 'id_event', 'events', 'id_events', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this -> dropTable('events_user');
        $this -> dropTable('events');
        $this -> dropTable('user');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181212_105407_create_calendar_tables cannot be reverted.\n";

        return false;
    }
    */
}
