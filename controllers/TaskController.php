<?php

namespace app\controllers;

use app\models\Goal;
use app\models\TaskSearch;
use Yii;
use app\models\Task;
use yii\base\UserException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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
     * Lists all Task models.
     * @return mixed
     * @throws UserException
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ( !$searchModel->goal_id )
            throw new UserException('Goal id is not provided');

        if ( !$searchModel->goal )
            throw new UserException("Goal [$searchModel->goal_id] not found");

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'goal' => $searchModel->goal
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws UserException
     */
    public function actionCreate()
    {

        $goalId = (int)Yii::$app->request->get('goal_id', 0);
        if ( !$goalId )
            throw new UserException('Goal id is not provided');

        $goal = Goal::findOne($goalId);
        if ( !$goal)
            throw new UserException("Goal [$goalId] not found");

        $model = new Task([
            'goal_id' => $goalId,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($model->goal->urlTaskList());
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($model->goal->urlTaskList());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Task model.
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
     * Closes task and return to list interface
     * @throws UserException
     */
    public function actionCloseTask() {

        $taskId = (int)Yii::$app->request->get('task_id', 0);
        if ( !$taskId )
            throw new UserException('No task id provided');

        $task = $this->findModel($taskId);

        $task->closed = 1;
        $task->save();

        $this->redirect(\Yii::$app->request->referrer);

    }

    /**
     * Open task and return to list interface
     * @throws UserException
     */
    public function actionOpenTask() {

        $taskId = (int)Yii::$app->request->get('task_id', 0);
        if ( !$taskId )
            throw new UserException('No task id provided');

        $task = $this->findModel($taskId);

        $task->closed = 0;
        $task->save();

        $this->redirect(\Yii::$app->request->referrer);

    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
