<?php
    namespace app\commands;
    
    use app\modules\calendarEvents\models\Events;
    use yii\console\Controller;
    use yii\console\ExitCode;
    use Yii;
    
    class EventsNotifyController extends Controller {
        
        public function actionSendout() {
            
            $events = Events::find()
                ->with('user')
                ->andWhere(["<=", "CAST(startDay AS DATE)", Yii::$app->params['currentDate']])
                ->andWhere([">=", "CAST(endDay AS DATE)", Yii::$app->params['currentDate']])
                ->all();
            
            $userEvents = [];
            
            foreach ($events as $event) {
                if(!isset($userEvents[$event->user['id_user']])) {
                    $userEvents[$event->user['id_user']] = [];
                }
                
                $userEvents[$event->user['id_user']]['email'] =
                $event->user['email'];
                $userEvents[$event->user['id_user']][] = [
                'text' => $event->title,
                ];
            }
            
            foreach ($userEvents as $userEvent) {
                Yii::$app->mailer->compose([
                'html' => 'events-notify-html',
                ], ['items' => $userEvent])
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($userEvents['email'])
                ->setSubject("Your events to day")
                ->setCharset("UTF-8")
                ->send();
            }

            return ExitCode::OK;
        }
    }
?>