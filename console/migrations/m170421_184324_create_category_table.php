<?php

use yii\db\Migration;
use yii\db\Schema;  
/**
 * Handles the creation of table `category`.
 */
class m170421_184324_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'category_id' => $this->primaryKey(),
            'category'  => Schema::TYPE_STRING . ' NOT NULL',
             
        ]);
               
        $this->insert('category', [
            'category_id' => '1',
            'category' => 'Cars',
        ]);

        $this->insert('category', [
            'category_id' => '2',
            'category' => 'Mobiles',
        ]);

        $this->insert('category', [
            'category_id' => '3',
            'category' => 'Tablets',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
