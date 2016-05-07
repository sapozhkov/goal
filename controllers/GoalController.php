<?php

namespace app\controllers;

use app\models\GoalForm;
use app\models\Task;
use Yii;
use app\models\Goal;
use app\models\GoalSearch;
use app\models\Log;
use yii\base\ErrorException;
use yii\base\UserException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoalController implements the CRUD actions for Goal model.
 */
class GoalController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $logRows = Log::find()
            ->where(['goal_id' => $id])
            ->orderBy('created_at DESC')
            ->limit(5)
            ->all()
        ;

        $taskRows = Task::find()
            ->where([
                'goal_id' => $id,
                'closed' => 0
            ])
            ->orderBy('date')
            ->limit(5)
            ->all()
        ;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'logRows' => $logRows,
            'taskRows' => $taskRows,
            'logModel' => new Log(['goal_id' => $id])
        ]);
    }

    public function actionCloseTask() {

        $taskId = (int)Yii::$app->request->get('task_id', 0);
        if ( !$taskId )
            throw new UserException('No task id provided');

        $task = Task::findOne($taskId);
        if ( !$task )
            throw new UserException("Task [$taskId] not found");

        $task->closed = 1;
        $task->save();

        $this->redirect(['view', 'id' => $task->goal->id]);

    }

    /**
     * Creates a new Goal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Goal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = GoalForm::findOne($id);

        if ( !$model )
            throw new NotFoundHttpException();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionMessage() {

        $model = new Log();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->goal_id]);
        } else {
            throw new ErrorException('Cannot add message');
        }

    }

    /**
     * Finds the Goal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
