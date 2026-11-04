<?php

declare(strict_types=1);

namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

final class ListButtonsWidget extends Widget
{
    public function run()
    {
        echo Html::a(Yii::t('app', 'Add Record'), ['create'], ['class' => 'btn btn-success btn-sm']);
        echo Html::a(Yii::t('app', 'Refresh Page'), ['index'], ['class' => 'btn btn-info btn-sm', 'style' => "margin-left: 10px"]);
    }
}