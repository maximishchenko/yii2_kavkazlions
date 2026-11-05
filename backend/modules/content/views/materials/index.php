<?php

use backend\widgets\BaseCrudActionColumn;
use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\search\MaterialsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Materials');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materials-index">

    <div class="alert alert-warning">
        <?= Yii::t('app', 'MATERIALS_INDEX_HINT') ?>
    </div>

    <p class="text-right">
        <?= ListButtonsWidget::widget() ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            [
                'class' => LinkColumn::class,
                'attribute' => 'name',
                'contentOptions' => ['class' => 'text-wrap'],
                'headerOptions' => array(
                    'class' => 'sort-numerical',
                ),
            ],
            'comment:ntext',
            [
                'class' => SetColumn::class,
                'filter' => Status::getStatusesArray(),
                'attribute' => 'status',
                'name' => function($data) {
                    return ArrayHelper::getValue(Status::getStatusesArray(), $data->status);
                },
                'contentOptions' => ['style' => 'width:100px;'],
                'cssCLasses' => Status::getValuesCssClasses(),
            ],
            [
                'class' => BaseCrudActionColumn::class,
            ],
        ],
    ]); ?>


</div>
