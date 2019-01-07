<?php
	namespace app\modules\calendarEvents\controllers;

	use Yii;
	use app\modules\calendarEvents\models\Events;
	use yii\filters\AccessControl;
	use yii\web\Controller;

	/**
	 * Default controller for the `calendarEvents` module
	 */
	class DefaultController extends Controller {

		public function behaviors() {
			return [
				'access' => [
					'class' => AccessControl::className(),
					'only'  => ['form'],
					'rules' => [
						[
						'actions' => ['index'],
						'allow' => true,
						'roles' => ['@']
						],
						[
						'actions' => ['form'],
						'allow' => true,
						'roles' => ['admin', 'simple'],
						],
					],
				]
			];
		}

	    /**
	     * Renders the index view for the module
	     * @return string
	     */
	    public function actionIndex() {
	    	$isAdmin = Yii::$app->user->can('admin');
	        $find = Events::find();
	        
	        if(!$isAdmin) {
	            $find = $find->where([
	                'id_user' => Yii::$app->user->id,
	            ]);
	        }

	    	$eventsUser = $find->all();
	    	if (!isset($_SESSION['calendarDate'])) {
	    		$calendarDate = date('Y-m-01');
	    	} else {
	    		$calendarDate = $_SESSION['calendarDate'];
	    	}
	    	
	        return $this->render('index',
	        	[
	        		'eventsUser' => $eventsUser,
	        		'date' => Yii::$app->params['dateFormatView'],
	        		'calendarDate' => $calendarDate,
	    		]);
	    }

		public function actionMonth() {

			if (isset($_SESSION['calendarDate'])) {
				$calendarDate = $_SESSION['calendarDate'];
			}
						
			if (isset($_GET['month'])) {
				$month = $_GET['month'];
			}

			if ($month == 'prev') {
				$calendarDate = date('Y-m-01', strtotime($calendarDate . '-1 month'));
			} else if ($month == 'next') {
				$calendarDate = date('Y-m-01', strtotime($calendarDate . '+1 month'));
			}

			$_SESSION['calendarDate'] = $calendarDate;
		
			return $this -> redirect(['index']);
		}
	}
?>