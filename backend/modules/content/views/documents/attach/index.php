<?php

use backend\widgets\BaseCrudActionColumn;
use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\Helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var backend\modules\content\models\Documents $model */

$this->title = Yii::t('app', 'Documents Attaches');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-attaches-index">


    <?= $this->render('../tabs/_tabs_update', ['model' => $model]); ?>

    <p class="text-right">
        <?= Html::a(Yii::t('app', 'Add Record'), ['create-attach', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']); ?>
        <?= Html::a(Yii::t('app', 'Refresh Page'), ['attaches', 'id' => $model->id], ['class' => 'btn btn-info btn-sm', 'style' => "margin-left: 10px"]); ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false,
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
                'attribute' => 'name',
                'contentOptions' => ['class' => 'text-wrap'],
                'headerOptions' => ['class' => 'sort-numerical'],
                'value' => function($data) {
                    return Html::a($data->name, ['update-attach', 'id' => $data->document_id, 'attachId' => $data->id]);
                },
                'format' => 'html',
            ],
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
                'urlCreator' => static function ($action, $attach) {
                    return Url::to([$action . '-attach', 'id' => $attach->document_id, 'attachId' => $attach->id]);
                },
            ],
        ],
    ]); ?>


</div>
