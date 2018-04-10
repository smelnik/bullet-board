<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_info`.
 */
class m180410_123237_create_user_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_info', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->null(),
            'middle_name' => $this->string()->null(),
            'last_name' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'birth_date' => $this->dateTime()->null(),
            'avatar_url' => $this->string()->null(),
            'rating_avg' => $this->tinyInteger()->notNull()->defaultValue(0),
        ]);

        $this->createIndex(
            'idx-user_id',
            'user_info',
            'user_id',
            true
        );

        $this->addForeignKey(
            'fk-user_info-user_id',
            'user_info',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_info-user_id', 'user_info');
        $this->dropIndex('idx-user_id', 'user_info');
        $this->dropTable('user_info');
    }
}
