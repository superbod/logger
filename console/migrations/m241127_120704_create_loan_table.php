<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%loan}}`.
 */
class m241127_120704_create_loan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%loan}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer(),
            'amount' => $this->integer(),
            'term' => $this->integer(4),
            'purpose' => $this->text(),
            'status' => $this->integer(4)->defaultValue(0),
            'monthly_income' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex('idx-loan-user_id', '{{%loan}}', 'userId');
        $this->createIndex('idx-loan-amount', '{{%loan}}', 'amount');
        $this->createIndex('idx-loan-term', '{{%loan}}', 'term');
        $this->createIndex('idx-loan-monthly_income', '{{%loan}}', 'monthly_income');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%loan}}');
    }
}
