<?php

/** @var backend\modules\content\models\ManagementCompany $model */
/** @var \yii\data\ActiveDataProvider $leadersDataProvider */
/** @var backend\widgets\BaseActiveForm $form */

use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<div class="col-md-12">
    <div class="alert alert-warning">
        <?= Yii::t('app', 'MANAGEMENT_COMPANIES_LEADERS_ADDITIONAL_HINT') ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $leadersDataProvider,
        'filterModel' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a($data->name, ['/content/management-leader/update', 'id' => $data->id], []);
                }
            ],
            'title',
            [
                'class' => SetColumn::class,
                'filter' => false,
                'attribute' => 'status',
                'name' => function($data) {
                    return ArrayHelper::getValue(Status::getStatusesArray(), $data->status);
                },
                'contentOptions' => ['style' => 'width:100px;'],
                'cssCLasses' => Status::getValuesCssClasses(),
            ],
        ],
    ]); ?>
</div>