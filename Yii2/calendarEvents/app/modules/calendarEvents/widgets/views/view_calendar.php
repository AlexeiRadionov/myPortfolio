<?php
    use yii\helpers\Html;

    $first = $date->modify('first day of this month');
    $firstDay = ($first->format('w') + 7) % 7;
    $totalDay = $first->format('t');
    $cellCount = ($firstDay + $totalDay + (7 - (($firstDay + $totalDay) % 7)));
    
    $eventsMonth = [];
    
    $calendarDate = strtotime(date('Y-m', strtotime($date->format('Y-m'))));
    
    foreach ($activities as $value) {
        foreach ($value as $item) {
            
            if (
                (strtotime(date('Y-m', strtotime($item['startDay']))) == $calendarDate
                || strtotime(date('Y-m', strtotime($item['endDay']))) == $calendarDate)
                || (strtotime(date('Y-m', strtotime($item['startDay']))) < $calendarDate
                && strtotime(date('Y-m', strtotime($item['endDay']))) > $calendarDate)
            ) {

                $count = date('Y-m-d', strtotime($item['startDay']));

                while (strtotime(date('Y-m', strtotime($count))) != $calendarDate) {

                    $count = date('Y-m-d', strtotime($count . '+1 days'));

                }
           
                while (strtotime($count) <= strtotime(date('Y-m-d', strtotime($item['endDay']))) && strtotime(date('Y-m', strtotime($count))) == $calendarDate) {
                    
                    $numberDay = (int)date('j', strtotime($count));
                    
                    $eventsMonth[][$numberDay] = [$item['title'], $item['id_events']];

                    $count = date('Y-m-d', strtotime($count . '+1 days'));
                }
            }
        }
    }
?>

<table class="table table-bordered">
    <tr>
        <th colspan='7'>
            <?= Html::a('Prev', ['month?month=prev'], ['class' => 'prev']) ?>
            <?= Html::a('Next', ['month?month=next'], ['class' => 'next']) ?>

            <?php echo $date->format('F Y'); ?>
        </th>
    </tr>
    <tr>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wed</th>
        <th>Thu</th>
        <th>Fri</th>
        <th>Sat</th>
        <th>Sun</th>
    </tr>
    
    <tr>
        <?php for($i = 1, $day = 0; $i <= $cellCount; $i ++): ?>
            
           <?php if ($calendarDate == strtotime(date('Y-m')) && ($day + 1) == (int)date('j')): ?>
                
                <td class="currentDay">
            
            <?php else: ?>
                <td class="otherDay">
            <?php endif; ?>
                
                <?php if( $i >= $firstDay && $day < $totalDay ):?>
                    <?php  echo ++$day; ?>
                    <ul>
                        <?php foreach ($eventsMonth as $value): ?>

                            <?php foreach ($value as $key => $item): ?>
                            
                                <?php if($key == $day): ?>
                                               
                                    <li>
                                        <?php echo '<a class="event" href="/calendarEvents/events/' . $item[1] . '">' . $item[0]; ?></a>
                                    </li>
                                                   
                                <?php endif; ?>

                            <?php endforeach; ?>
                            
                        <?php endforeach; ?>
                    </ul>
                    
                    
                <?php endif; ?>
            </td>

            <?php if($i % 7 == 0):?>
    </tr>
    <tr>
            <?php endif; ?>

        <?php endfor; ?>
    </tr>
</table>

<script>
    var events = document.getElementsByClassName('event');
    for (var i = 0; i < events.length; i++) {
        var cellWithEvent = events[i].parentNode.parentNode.parentNode;
        cellWithEvent.classList.add('cellWithEvent');       
    }
</script>