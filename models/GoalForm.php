<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 09.11.2015
 * Time: 18:21
 */

namespace app\models;


use yii\helpers\ArrayHelper;

/**
 * Class GoalForm
 * @package app\models
 * @method static GoalForm|null findOne($condition)
 * @method bool load($data)
 */
class GoalForm extends Goal
{

    public $log_message;

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['log_message', 'safe']
            ]
        );
    }

}