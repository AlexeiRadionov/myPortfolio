<?php
    use yii\helpers\Html;
    use yii\grid\GridView;

    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents', 'label' => 'Calendar'];
    $this->title = 'Users';
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/events', 'label' => 'Events'];
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/events/day', 'label' => 'Events today'];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id_user',
                'username',
                //'auth_key',
                //'password_hash',
                //'password_reset_token',
                'email:email',
                //'created_at',
                //'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    ?>
</div>
