<?php
    use app\modules\calendarEvents\assets\EventsAsset;

    EventsAsset::register($this);

    $this->title = 'Calendar';
    $this->params['breadcrumbs'][] = $this->title;
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/events', 'label' => 'Events'];
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/events/day', 'label' => 'Events today'];
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/user', 'label' => 'Users'];
?>

<h1>Calendar events</h1>
<hr/>

<p>
    <a href="/calendarEvents/events/create" class='btn btn-success'>Create event</a>
</p>

<div>
    <?php echo \app\modules\calendarEvents\widgets\Calendar::widget([
            'activities' => $eventsUser,
            'date'       => new \DateTime($calendarDate), // TODO тут меняем время
    ]); ?>
</div>