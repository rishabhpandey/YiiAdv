<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php
$form = ActiveForm::begin([
    'id'      => 'ajaxForm',
    //'action'  =>'',
    //'enableAjaxValidation'=>true,
    //'enableClientValidation'=>true,
    'options' => ['enctype' => 'multipart/form-data'],
]);
?>

    <?=$form->field($model, 'username')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'email')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'password')->passwordInput(['maxlength' => true])?>

    <?=$form->field($model, 'photo')->fileInput(['id'=>'sortpicture'])?>

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success', 'id'=>'submit'])?>
        <?=Html::a('Back', ['index', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
<?php
$this->registerJs('
        $("#submit").click(function(){
            var formData = new FormData($(this)[0]);
            var file = $("#sortpicture")[0].files;
            formData.append("photo", file);
            //alert(formData);
            
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data   : formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        alert(data);
                    },

                });
            return false;
            })' , yii\web\View::POS_READY
    );