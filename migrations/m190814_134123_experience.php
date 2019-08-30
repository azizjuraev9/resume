<?php

use yii\db\Migration;

/**
 * Class m190814_134123_experience
 */
class m190814_134123_experience extends Migration
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

        $this->createTable('experience', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'specialty' => $this->string()->notNull(),
            'beginning_date' => $this->date()->notNull(),
            'ending_date' => $this->date()->notNull(),
            'type' => "enum('education','work') NOT NULL",
        ], $tableOptions);


        $this->createIndex(
            'experience-employee_id-index',
            'experience',
            'employee_id'
        );

        $this->addForeignKey(
            'experience-employee_id-fk',
            'experience',
            'employee_id',
            'employees',
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
        echo "m190814_134123_experience cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190814_134123_experience cannot be reverted.\n";

        return false;
    }
    */
}
