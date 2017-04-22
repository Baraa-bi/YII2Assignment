<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Alert;
use backend\models\Post;
use backend\models\Posttags;
use backend\models\Category;
use backend\models\User;
use backend\models\Tags;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
        <?php

                $session = Yii::$app->session;
                if($session->hasFlash('notAllowed'))
                {
                    echo Alert::widget([
                    'options' => ['class' => 'alert-danger'],
                    'body' => Yii::$app->session->getFlash('notAllowed'),]);
                }

        ?>   
    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    
    <a class="btn btn-warning" href='index.php?r=post/duplicated'>Duplicated Posts</a>
    </p>
    <div class="container text-center">
<div class="table-striped">
<table class="table">
<thead>
<tr>
<th>PostId</th>
<th>PostTitle</th>
<th>PostDescription</th>
<th>PostAuthor</th>
<th>PostCategory</th>
<th>PostTags</th>
<th>PostEdit</th>
<th>PostDelete</th>

</tr>
</thead>
<tbody>
<?php
    foreach ($data as $model) {
    echo '<tr>';
    echo '<td>'.$model->post_id.'</td>';
    echo '<td>'.$model->post_title.'</td>';
    echo '<td>'.$model->post_description.'</td>';
    echo '<td>'.User::find()->where(['id'=>$model->author_id])->one()->username.'</td>';
    echo '<td>'.Category::find()->where(['category_id'=>$model->category_id])->one()->category.'</td>';
    $tags=posttags::find()->where(['post_id'=>$model->post_id])->All();
        

            $value='<div class="">';
            foreach ($tags as $variable) {
                $value.=' <a class="btn btn-info">'.Tags::find()->where(['tag_id'=>$variable->tag_id])->one()->tag.'</a>';
            }
            $value.='</div>';
            echo '<td>'.$value.'</td>';
        
    echo '<td><a href="index.php?r=post/update&id='.$model->post_id.'" class="btn btn-primary btn-block">Edit<a>'.'</td>';
    echo '<td><a method="post" href="index.php?r=post/delete&id='.$model->post_id.'" class="btn btn-danger btn-block">Delete<a>'.'</td>';
    echo '</tr>';
}
?>
</tbody>
</table>
</div>
</div>
</div>
