<?php

use backend\widgets\BaseCrudActionColumn;
use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\search\HistorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Histories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">


    
    <div class="alert alert-warning">
        <ul>
            <li>
                <?= Yii::t('app', 'HISTORY_NAME_IS_REQUIRED') ?>
            </li>
            <li>
                <?= Yii::t('app', 'HISTORY_TITLE_IS_OPTIONAL') ?>
            </li>
            <li>
                <?= Yii::t('app', 'STATUS_IS_OPTIONAL_WITH_DEFAULT_VALUE') ?>
            </li>
            <li>
                <?= Yii::t('app', 'COMMENT_IS_OPTIONAL_AND_SERVICE') ?>
            </li>
            <li>
                <?= Yii::t('app', 'HISTORY_DESCRIPTION_IS_REQUIRED') ?>
            </li>
        </ul>
    </div>

    <p class="text-right">
        <?= ListButtonsWidget::widget() ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => LinkPager::class
        ],
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
            'title',
            'sort',
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
