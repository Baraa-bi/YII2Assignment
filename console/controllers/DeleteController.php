<?php
	namespace console\controllers;
    use backend\models\Post;
    use yii\helpers\Json;
    use yii;
    use yii\console\Controller;

class DeleteController extends Controller
{
    // The command "yii delete/delete-old-posts" will delete posts older than three days :D

    public function actionDeleteOldPosts() {
    	foreach (Post::find()->all() as $post) {
    		$post_id=$post->post_id;
			$diff=strtotime(date('y-m-d'))-strtotime(($post->created_date));
    		echo $diff;
    		if($diff>3)
    		{
    			$post->delete();
    			echo 'post with id '.$post_id.'has been deleted successfuly';
    		}
		}
   	}
}
