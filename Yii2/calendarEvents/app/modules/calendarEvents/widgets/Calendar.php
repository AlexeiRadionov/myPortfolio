<?php
/**
 * Created by PhpStorm.
 * User: vench
 * Date: 23.12.18
 * Time: 18:25
 */
namespace app\modules\calendarEvents\widgets;
/**
 * Class Calendar
 * @package app\modules\activity\widgets
 */
class Calendar extends \yii\base\Widget
{
    /**
     * @var \app\modules\activity\models\Activity[]
     */
    public $activities;
    /**
     * @var \DateTime
     */
    public $date;
    /**
     * @return string
     */
    public function run()
    {
        if(is_null($this->date)) {
            $this->date = new \DateTime();
        }
        return $this->render('view_calendar', [
            'activities' => $this->activitiesToMap(),
            'date'       => $this->date,
        ]);
    }
    /**
     * @return array
     */
    private function activitiesToMap() {
        $hash = [];
        foreach ($this->activities as $activitie) {
            // TODO нормальный вариант ключа по дате начала и конца
            $key = $this->getDayFromDate($activitie->startDay);
            if(!isset($hash[$key])) {
                $hash[$key] = [];
            }
            $hash[$key][] = $activitie;
        }
        return $hash;
    }
    /**
     * @param $date
     * @return false|int|string
     */
    private function getDayFromDate($date) {
        if(is_string($date)) {
            return date('d', strtotime($date));
        } else if($date instanceof \DateTime) {
            return $date->format('d');
        }
        return 0;
    }
} 