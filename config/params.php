<?php

return \yii\helpers\ArrayHelper::merge([
    'adminEmail' => 'admin@example.com',
    'domain' => 'example.com',
], require(__DIR__ . '/params-local.php'));
