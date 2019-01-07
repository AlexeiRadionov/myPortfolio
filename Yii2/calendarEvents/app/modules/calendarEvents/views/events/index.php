<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['url' => '/calendarEvents', 'label' => 'Calendar'];

if ($day) {
    $this->title = 'Events today';
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/events', 'label' => 'Events'];
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Events';
    $this->params['breadcrumbs'][] = $this->title;
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/events/day', 'label' => 'Events today'];
}

$this->params['breadcrumbs'][] = ['url' => '/calendarEvents/user', 'label' => 'Users'];
?>

<?php if ($day): ?>
    <h4>Today: <?php echo date('d-m-Y') . " $day"?></h4>
    <hr>
<?php endif; ?>

<div class="events-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute' => 'username',
            'value' => function($data){return $data->user->username;}
            ],

            'id_events',
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
            //'description:ntext',
            //'isBlock',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>