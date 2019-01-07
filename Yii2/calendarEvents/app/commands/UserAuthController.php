<?php
	namespace app\commands;
	
	use Yii;
	use yii\console\Controller;
	use yii\console\ExitCode;
	
	class UserAuthController extends Controller {
		
		public function actionInit() {
			$role = Yii::$app->authManager->createRole('admin');
			$role->description = 'Администратор';
			Yii::$app->authManager->add($role);
			
			$role = Yii::$app->authManager->createRole('simple');
			$role->description = 'Пользователь';
			Yii::$app->authManager->add($role);
		}

		public function actionAssign($role, $userId) {
	        $authManager = Yii::$app -> authManager;
	        $modelRole = $authManager -> getRole($role);
	        
	        if(is_null($modelRole)) {
	            Console::error("Model role {$role} not found!!!");
	            return ExitCode::OK;
	        }
	        
	        $authManager -> assign($modelRole, $userId);
	        return ExitCode::OK;
	    }
	}
?>