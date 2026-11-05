<?php

use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use common\models\Status;
use backend\widgets\BaseCrudActionColumn;
use backend\widgets\SetColumn;
use yii\bootstrap5\LinkPager;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\search\ManagementCompanySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Management Companies');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="management-company-index">

    <div class="alert alert-warning">
        <?= Yii::t('app', 'MANAGEMENT_COMPANIES_INDEX_HINT') ?>
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
                'attribute' => 'managementLeadersCount',
                'filter' => false,
            ],
            [
                'class' => BaseCrudActionColumn::class,
            ],
        ],
    ]); ?>


</div>
