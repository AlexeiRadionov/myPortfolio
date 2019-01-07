<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/* @var $this yii\web\View */
	/* @var $model app\models\User */
	/* @var $form ActiveForm */
	$this->title = 'Registration';
	$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-registration">

    <?php $form = ActiveForm::begin(); ?>
		<?php echo $form -> field($model, 'username'); ?>
		<?php echo $form -> field($model, 'password') -> textinput(['type'=>'password']); ?>
		<?php echo $form -> field($model, 'email') -> textinput(['type'=>'email']); ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-registration -->