<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\calendarEvents\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startDay')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'endDay')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'id_user')->textInput(['value' => Yii::$app -> user -> id, 'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <!-- <?php echo $form -> field($model, 'isBlock') -> checkbox(); ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>