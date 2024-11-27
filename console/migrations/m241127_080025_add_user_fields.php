<?php

use yii\db\Migration;

/**
 * Class m241127_080025_add_user_fields
 */
class m241127_080025_add_user_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'first_name', $this->string(32)->defaultValue(null));
        $this->addColumn('{{%user}}', 'last_name', $this->string(32)->defaultValue(null));
        $this->addColumn('{{%user}}', 'date_of_birth', $this->date()->defaultValue(null));
        $this->addColumn('{{%user}}', 'pasport_number', $this->string(32)->defaultValue(null)->unique());
        $this->addColumn('{{%user}}', 'pasport_expiry_date', $this->date()->defaultValue(null));
        $this->addColumn('{{%user}}', 'uploaded_files', $this->json()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'first_name');
        $this->dropColumn('{{%user}}', 'last_name');
        $this->dropColumn('{{%user}}', 'date_of_birth');
        $this->dropColumn('{{%user}}', 'pasport_number');
        $this->dropColumn('{{%user}}', 'pasport_expiry_date');
    }
}
