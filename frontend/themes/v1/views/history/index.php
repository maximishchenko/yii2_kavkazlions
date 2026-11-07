<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string | null $historyTopParallaxText */
/** @var string | null $historyBottomParallaxText */

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

<section class="home-parallax history-parallax">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">
            <?= $historyTopParallaxText ?>
        </h2>
    </div>
</section>

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

<section class="home-parallax history-parallax">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">
            <?= $historyBottomParallaxText ?>
        </h2>
    </div>
</section>
