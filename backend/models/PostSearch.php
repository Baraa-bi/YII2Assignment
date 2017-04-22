<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Post;

/**
 * PostSearch represents the model behind the search form about `backend\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'integer'],
            [['post_title', 'author_id','category_id', 'post_description', 'created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'created_date' => $this->created_date,
        ]);

            $query->joinWith('category');

            $query->joinWith('author');

            $query->joinWith('posttags');
            

        $query->andFilterWhere(['like', 'post_title', $this->post_title])
               ->andFilterWhere(['like', 'post_description', $this->post_description])
            ->andFilterWhere(['like', 'category', $this->category_id])
            ->andFilterWhere(['like', 'username', $this->author_id])
            ->andFilterWhere(['like', 'tag_id', $this->post_id]);
        return $dataProvider;
    }
}
