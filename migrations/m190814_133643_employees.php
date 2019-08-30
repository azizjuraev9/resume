<?php

use yii\db\Migration;

/**
 * Class m190814_133643_employees
 */
class m190814_133643_employees extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('employees', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(20)->notNull(),
            'secondname' => $this->string(20)->notNull(),
            'lastname' => $this->string(20)->notNull(),
            'birth_date' => $this->date()->notNull(),
            'nation' => $this->integer()->notNull(),
            'phone' => $this->string(20)->notNull(),
            'email' => $this->string()->notNull(),
            'photo' => $this->string(),
            'qr' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190814_133643_employees cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190814_133643_employees cannot be reverted.\n";

        return false;
    }
    */
}
