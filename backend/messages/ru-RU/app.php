<?php
use yii\helpers\ArrayHelper;


return ArrayHelper::merge(
    require __DIR__ . '/backend.php',
    require __DIR__ . '/../../modules/management/messages/ru-RU/app.php',
);