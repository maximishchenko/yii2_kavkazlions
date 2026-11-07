<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use frontend\assets\FancyboxAsset;
use yii\widgets\ListView;

FancyboxAsset::register($this);
$this->registerJs('Fancybox.bind("[data-fancybox]");', \yii\web\View::POS_END);

$this->title = Yii::t('app', 'History Title');
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
        'class' => 'history-list',
    ],
    'itemOptions' => static function ($model) {
        return [
            'tag' => 'article',
            'class' => 'history-item' . ($model->image ? '' : ' history-item--no-image'),
        ];
    },
    'emptyText' => '',
]) ?>
