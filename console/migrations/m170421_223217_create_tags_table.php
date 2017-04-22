<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tags`.
 * Has foreign keys to the tables:
 *
 * - `category`
 */
class m170421_223217_create_tags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tags', [
            'tag_id' => $this->primaryKey(),
            'category_id' => $this->integer()->defaultValue(null),
            'tag' => $this->string(100),
        ]);

        $this->insert('tags', [
            'category_id' => '1',
            'tag' => 'toyota',
        ]);

        $this->insert('tags', [
            'category_id' => '1',
            'tag' => 'honda',
        ]);

        $this->insert('tags', [
            'category_id' => '1',
            'tag' => 'gmc',
        ]);
        $this->insert('tags', [
            'category_id' => '1',
            'tag' => 'automatic',
        ]);
        $this->insert('tags', [
            'category_id' => '1',
            'tag' => 'manual',
        ]);
        $this->insert('tags', [
            'category_id' => '1',
            'tag' => 'hyprid',
        ]);
        $this->insert('tags', [
            'category_id' => '1',
            'tag' => 'gas',
        ]);
        $this->insert('tags', [
            'category_id' => '2',
            'tag' => 'iphone',
        ]);
        $this->insert('tags', [
            'category_id' => '2',
            'tag' => 'galaxy s',
        ]);
        $this->insert('tags', [
            'category_id' => '2',
            'tag' => 'galaxy note',
        ]);
        $this->insert('tags', [
            'category_id' => '3',
            'tag' => 'ipad',
        ]);
         $this->insert('tags', [
            'category_id' => '3',
            'tag' => 'galaxy tab',
        ]);
          $this->insert('tags', [
            'tag' => 'black',
        ]); $this->insert('tags', [
            'tag' => 'white',
        ]);
        

        

        
        
        

        // creates index for column `category_id`
        $this->createIndex(
            'idx-tags-category_id',
            'tags',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-tags-category_id',
            'tags',
            'category_id',
            'category',
            'category_id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-tags-category_id',
            'tags'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-tags-category_id',
            'tags'
        );

        $this->dropTable('tags');
    }
}
