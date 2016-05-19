<?php

namespace app\assets;

use yii\web\AssetBundle;

class DiffAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/diff.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];
}
