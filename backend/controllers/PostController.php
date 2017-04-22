<?php

namespace backend\controllers;

use Yii;
use backend\models\Post;
use backend\models\Tags;
use backend\models\Posttags;
use backend\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Html;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        'access' =>[
                'class' =>AccessControl::className(),
                'only' =>['create','update'],
                'rules' => [
                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ]
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data'=>Post::find()->all(),
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_date=date('y-m-d');
            $model->author_id=Yii::$app->user->getId();
            $model->save();
            return $this->redirect(['view', 'id' => $model->post_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->getId()!=$model->author_id){
        $session = Yii::$app->session;
        $session->setFlash('notAllowed','You are Not Allowed To Update This post');
    
            return $this->redirect('index.php?r=post/index');
    }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode($model->post_id);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->getId()!=$model->author_id){
        $session = Yii::$app->session;
        $session->setFlash('notAllowed','You are Not Allowed To Delete This post');
    
            return $this->redirect('index.php?r=post/index');
    }
    $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionGetTags($categoryId)
    {
        $tags=Tags::find()->where(['category_id'=>$categoryId])->all();
        echo Json::encode($tags);
    }

    public function actionCreatePost()
    {
        $model = new Post();
        if ($model->load(Yii::$app->request->post())) {
            $model->created_date=date('y-m-d');
            $model->author_id=Yii::$app->user->getId();
            $model->save();        
            echo Json::encode($model->post_id);
        }
            
    }
public function actionSavePostTags($tag_id,$post_id)
    {
        $model = new posttags();
        static $update=1;
        if($update==1)
           {
        $model->deleteAll(['post_id'=>$post_id]);
        $update++;
        }
        $model->post_id=$post_id;
        $model->tag_id=$tag_id;
        $model->save();
        echo Json::encode($model);
    }

    public function actionDuplicated()
    {
        $duplicate=[];
        foreach (Post::find()->all() as $post) {
            if($post->post_title==$post->post_description)
            {
                array_push($duplicate, $post);    
            }
        }
                return $this->render('index', [
            'data' => $duplicate
        ]);
    }



}
