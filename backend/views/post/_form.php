<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\registerJs;
use yii\helpers\ArrayHelper;
use backend\models\category;
use backend\models\Tags;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'post_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_description')->textInput() ?>

    <?= $form->field($model,'category_id')->dropDownList(
            ArrayHelper::map(Category::find()->all(),'category_id','category'),
            ['prompt'=>'Select Category','id'=>'categoryId'])?>
    
    <label class="control-label" for="tags">Post Tags :</label><hr>    
    <div  id="tags" style="display:inline;">
    </div>
    <hr>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script=<<< JS


$("#categoryId").change(function(){

$("div[name=tag]").remove();
categoryId=$(this).val();
$.getJSON('index.php?r=post/get-tags&categoryId='+categoryId, function( json ) {
for(var i = 0 ; i<json.length;i++){
        
        tag='<div name="tag" class="checkbox">'+
                    '<label>'+
            '<input name="tag" value='+json[i].tag_id+' type="checkbox">'+
                    '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>'+
                        json[i].tag+
                    '</label>'+
                '</div>';
        $("#tags").append(tag);
    }
 t=1;
});
});

$("#w0").submit(function(e){
    if(t==1){
        var formURL;
        if($('#button').text()=='Update')            
        formURL = $(this).attr("action");
        else
        formURL = 'index.php?r=post/create-post';
            
    var postData = $(this).serializeArray();
    $.ajax(
    {
        url : formURL,
        type: "POST",
        crossDomain: true,
        data : postData,
        success:function(json, textStatus, jqXHR)
        {
               saveTags(json);
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
        }
    });
t++;
}
    e.preventDefault(); 
});

function saveTags(post_id)
{
 $('input[name=tag]:checked').each(function() {
        $.getJSON('index.php?r=post/save-post-tags&tag_id='+$(this).val()+'&post_id='+post_id, function( json ) {
        });
});
setTimeout(function(){
          window.location.href ='index.php?r=post/view&id='+post_id;

}, 500);
}

JS;
$this->registerJs($script);


?>