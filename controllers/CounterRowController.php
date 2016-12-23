<?php

namespace app\controllers;

use app\models\Counter;
use Yii;
use app\models\CounterRow;
use app\models\CounterRowSearch;
use yii\base\UserException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CounterRowController implements the CRUD actions for CounterRow model.
 */
class CounterRowController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CounterRow models.
     * @return mixed
     * @throws UserException
     */
    public function actionIndex()
    {
        $searchModel = new CounterRowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ( !$searchModel->counter_id )
            throw new UserException('Counter id is not provided');

        if ( !$searchModel->counter )
            throw new UserException("Counter [$searchModel->counter_id] not found");

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'counter' => $searchModel->counter,
        ]);
    }

    /**
     * Creates a new CounterRow model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws UserException
     */
    public function actionCreate()
    {

        $counterId = (int)Yii::$app->request->get('counter_id', 0);
        if ( !$counterId )
            throw new UserException('Counter id is not provided');

        $counter = Counter::findOne($counterId);
        if ( !$counter)
            throw new UserException("Counter [$counter] not found");

        $model = new CounterRow([
            'counter_id' => $counterId,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($model->counter->urlToLog());
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CounterRow model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($model->counter->urlToLog());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CounterRow model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CounterRow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CounterRow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CounterRow::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
