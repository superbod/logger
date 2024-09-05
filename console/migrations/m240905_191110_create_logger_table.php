<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%logger}}`.
 */
class m240905_191110_create_logger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%logger}}', [
            'id' => $this->primaryKey(),
            'message' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%logger}}');
    }
}
