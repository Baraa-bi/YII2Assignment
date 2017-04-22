<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property integer $tag_id
 * @property string $tag
 * @property integer $category_id
 *
 * @property Posttags[] $posttags
 * @property Category $category
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'tag', 'category_id'], 'required'],
            [['tag_id', 'category_id'], 'integer'],
            [['tag'], 'string', 'max' => 100],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Post Tags',
            'tag' => 'Tag',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosttags()
    {
        return $this->hasMany(Posttags::className(), ['tag_id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }
}
