<?php

use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var frontend\models\search\ManagementCompanySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Management Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title">
    <?= $this->title ?>
</h1>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'layout' => "{items}\n{pager}",
    'options' => [
        'tag' => 'div',
        'class' => 'people grid-3 companies',
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'person',
    ],
    'emptyText' => Yii::t('app', 'Management Companies Not Found'),
    'emptyTextOptions' => ['class' => 'management-companies__empty'],
]) ?>
