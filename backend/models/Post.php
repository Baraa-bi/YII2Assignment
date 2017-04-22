<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $post_id
 * @property string $post_title
 * @property string $post_description
 * @property string $created_date
 * @property integer $category_id
 * @property integer $author_id
 *
 * @property Category $category
 * @property User $author
 * @property Posttags[] $posttags
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_title', 'post_description', 'created_date', 'category_id', 'author_id'], 'required'],
            [['created_date'], 'safe'],
            [['category_id', 'author_id'], 'integer'],
            [['post_title'], 'string', 'max' => 100],
            [['post_description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'post_title' => 'Post Title',
            'post_description' => 'Post Description',
            'created_date' => 'Created Date',
            'category_id' => 'Category',
            'author_id' => 'Author',
            'tag' => 'tag',
              
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosttags()
    {
        return $this->hasMany(Posttags::className(), ['post_id' => 'post_id']);
    }


}
