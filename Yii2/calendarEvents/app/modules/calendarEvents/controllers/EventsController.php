<?php

namespace app\modules\calendarEvents\controllers;

use Yii;
use app\modules\calendarEvents\models\Events;
use app\modules\calendarEvents\models\Day;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;

/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                    'allow' => true,
                    'roles' => ['@']
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndex() {
        $find = Events::find();
        $isAdmin = Yii::$app->user->can('admin');
            
        if(!$isAdmin) {
            $find = $find->where([
                'id_user' => Yii::$app->user->id,
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $find,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDay() {
        $currentDate = Yii::$app->params['currentDate'];
        $day = new Day;
        $day -> getCurrentDay($currentDate);

        $find = Events::find();
        $find = $find
                ->andWhere(['id_user' => Yii::$app->user->id])
                ->andWhere(["<=", "CAST(startDay AS DATE)", $currentDate])
                ->andWhere([">=", "CAST(endDay AS DATE)", $currentDate]);

        $dataProvider = new ActiveDataProvider([
            'query' => $find,
        ]);

        return $this->render('index', 
            [
                'day' => $day -> currentDay,
                'dataProvider' => $dataProvider,
                'date' => Yii::$app->params['dateFormatView'],
            ]);
    }

    /**
     * Displays a single Events model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Events model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Events();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_events]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Events model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_events]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Events model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);    
    }

    /**
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Events::findOne($id)) !== null) {
            if ($model -> id_user == Yii::$app->user->id) {
            return $model;
            } else {
            throw new HttpException(403, 'You are not allowed to perform this action.');
            }
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
?>