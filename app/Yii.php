<?php

/**
 * Yii bootstrap file.
 * Перекрытие Yii для работы с phpstorm
 */

class Yii extends \yii\BaseYii
{
    /**
     * @var \app\app\Application the application instance
     */
    public static $app;

}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '../vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container;
