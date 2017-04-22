
<?php
    namespace app\;
    use backend/models/Post;
    use yii/helpers/Json;
    use yii\console\Controller;
class DeleteController extends Controller
{
    // The command "yii example/create test" will call "actionCreate('test')"
    public function actionDelete() {
            $posts = Post::find()->all();
            echo Json::encode($posts);
    }
}
?>