<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\calendarEvents\models\Events */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_events], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_events], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_events',
            [
            'attribute' => 'username',
            'value' => function($data){return $data->user->username;}
            ],
            'title',
            //'startDay',
            [
            'attribute' => 'Start Day',
            'value' => function($data){return date(Yii::$app->params['dateFormatView'], strtotime($data -> startDay));}
            ],
            //'endDay',
            [
            'attribute' => 'End Day',
            'value' => function($data){return date(Yii::$app->params['dateFormatView'], strtotime($data -> endDay));}
            ],
            //'id_user',
            'description:ntext',
            //'isBlock',
            'created_at',
            'updated_at'
        ],
    ]) ?>

</div>
