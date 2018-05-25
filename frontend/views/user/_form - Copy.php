<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div id="formAjaxMessage">
        
    </div>

    <?php
$form = ActiveForm::begin([
    'id'                   => 'ajaxForm',
    'enableAjaxValidation' => false,
    'options'              => ['enctype' => 'multipart/form-data'],
]);
?>

    <?=$form->field($model, 'username')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'email')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'password')->passwordInput(['maxlength' => true])?>

     <?=$form->field($model, 'photo')->fileInput(['accept' => 'image/*'])?>

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success submitForm'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
<?php

$this->registerJs(
    //(document).ready(function () {
    "$('.submitForm').on('submit', 'form#ajaxForm', function () {
            var form = $(this);
            // return false if form still have some validation errors
            if (form.find('.has-error').length)
            {
                return false;
            }
            // submit form
            $.ajax({
            url    : form.attr('action'),
            type   : 'post',
            data   : form.serialize(),
            dataType: 'json',
            success: function (data)
            {console.log('hiiiiiiiii')
                if(response.success){
                    $('#ajaxForm')[0].reset();    
                    $('#formAjaxMessage').html('<h1>successfully saved</h1>');    
                }
                return true;
            },
            error  : function ()
            {
                console.log('internal server error');
            }
            });
            return false;
         })", yii\web\View::POS_READY
    //});
);
?>