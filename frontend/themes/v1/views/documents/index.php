<?php

/** @var yii\web\View $this */

use yii\widgets\ListView;

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Documents Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title">
    <?= $this->title ?>
</h1>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_category',
    'layout' => '{items}',
    'options' => ['tag' => 'ul', 'class' => 'document-categories'],
    'itemOptions' => ['tag' => 'li', 'class' => 'sponsor-card'],
    'emptyText' => Yii::t('app', 'No categories found.'),
    'emptyTextOptions' => ['tag' => 'li'],
]) ?>
