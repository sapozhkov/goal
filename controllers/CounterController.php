<?php

namespace app\controllers;

use app\models\CounterRow;
use app\models\Goal;
use Yii;
use app\models\Counter;
use app\models\CounterSearch;
use yii\base\UserException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CounterController implements the CRUD actions for Counter model.
 */
class CounterController extends Controller
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
     * Lists all Counter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CounterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ( !$searchModel->goal_id )
            throw new UserException('Goal id is not provided');

        if ( !$searchModel->goal )
            throw new UserException("Goal [$searchModel->goal_id] not found");

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'goal' => $searchModel->goal,
        ]);
    }

    /**
     * Displays a single Counter model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Counter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $goalId = (int)Yii::$app->request->get('goal_id', 0);
        if ( !$goalId )
            throw new UserException('Goal id is not provided');

        $goal = Goal::findOne($goalId);
        if ( !$goal)
            throw new UserException("Goal [$goalId] not found");

        $model = new Counter([
            'goal_id' => $goalId,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Counter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Counter model.
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
     * Finds the Counter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Counter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Counter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAdd() {

        $model = new CounterRow([
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            var_dump( 1 );

//            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            var_dump( $model->errors );

            var_dump( 0 );
//            return $this->render('update', [
//                'model' => $model,
//            ]);
        }


    }

}
