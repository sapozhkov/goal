<?php

namespace app\controllers;

use app\models\Goal;
use Yii;
use app\models\Log;
use app\models\LogSearch;
use yii\base\UserException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LogController implements the CRUD actions for Log model.
 */
class LogController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Log models.
     * @return mixed
     * @throws UserException
     */
    public function actionIndex()
    {

        $goalId = (int)Yii::$app->request->get('goal_id', 0);
        if ( !$goalId )
            throw new UserException('Goal id is not provided');

        $goal = Goal::findOne($goalId);
        if ( !$goal)
            throw new UserException("Goal [$goalId] not found");

        $searchModel = new LogSearch([
            'goal_id' => $goalId
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'goal' => $goal,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Log model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($model->goal->urlLogList());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Log model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $log = $this->findModel($id);

        $url = $log->goal->urlLogList();
        $log->delete();

        return $this->redirect($url);
    }

    /**
     * Show difference for field in selected log
     * @param int $id
     * @param string $field
     * @return string
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionDiff($id, $field) {

        $id = (int)$id;
        $log = Log::findOne($id);
        
        if ( !$log )
            throw new NotFoundHttpException("Not found log [$id]");
        
        $data = json_decode($log->data, true);

        if ( !in_array($field, [
            'description',
            'smart_specific',
            'smart_measurable',
            'smart_achievable',
            'smart_relevant',
            'smart_time_bound'
        ]))
            throw new ForbiddenHttpException("Not allowed field");
        
        if ( !$data or !isset($data[$field]) )
            throw new NotFoundHttpException("No changes for field");

        return $this->render('diff', [
            'log' => $log,
            'field' => $field,
            'old' => $data[$field][0],
            'new' => $data[$field][1],
        ]);

    }

    /**
     * Finds the Log model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Log the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Log::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
