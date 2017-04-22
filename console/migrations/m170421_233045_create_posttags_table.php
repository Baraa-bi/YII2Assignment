<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posttags`.
 * Has foreign keys to the tables:
 *
 * - `post`
 * - `tag_id`
 */
class m170421_233045_create_posttags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posttags', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'tag_id' => $this->integer(11),
        ]);

        // creates index for column `post_id`
        $this->createIndex(
            'idx-posttags-post_id',
            'posttags',
            'post_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-posttags-post_id',
            'posttags',
            'post_id',
            'post',
            'post_id',
            'CASCADE'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-posttags-tag_id',
            'posttags',
            'tag_id'
        );

        // add foreign key for table `tag_id`
        $this->addForeignKey(
            'fk-posttags-tag_id',
            'posttags',
            'tag_id',
            'tags',
            'tag_id',
            'SET NULL'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `post`
        $this->dropForeignKey(
            'fk-posttags-post_id',
            'posttags'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            'idx-posttags-post_id',
            'posttags'
        );

        // drops foreign key for table `tag_id`
        $this->dropForeignKey(
            'fk-posttags-tag_id',
            'posttags'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            'idx-posttags-tag_id',
            'posttags'
        );

        $this->dropTable('posttags');
    }
}
