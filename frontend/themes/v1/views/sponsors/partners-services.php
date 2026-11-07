<?php

use frontend\models\PartnerServicesImages;
use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var frontend\models\search\PartnerServicesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Sponsors Partners Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title">
    <?= $this->title ?>
</h1>

<section class="home-parallax partners-services-parallax" aria-label="Партнёрство для развития спорта">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">Партнёрство для развития спорта</h2>
    </div>
</section>

<div class="layout">
    <div class="content">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'cards partner-services-list'],
            'itemOptions' => ['tag' => 'article', 'class' => 'card'],
            'itemView' => static function ($model) {
                $imageContent = '';

                foreach ($model->partnerServicesImages as $index => $image) {
                    $imageContent .= Html::img('/' . PartnerServicesImages::UPLOAD_PATH . $image->image, [
                        'alt' => $model->name,
                        'class' => $index === 0 ? 'is-active' : '',
                        'aria-hidden' => $index === 0 ? 'false' : 'true',
                        'loading' => 'lazy',
                    ]);
                }

                if (count($model->partnerServicesImages) > 1) {
                    $dots = '';

                    foreach ($model->partnerServicesImages as $index => $image) {
                        $dots .= Html::tag('span', '', ['class' => $index === 0 ? 'is-active' : '']);
                    }

                    $imageContent .= Html::tag('div', $dots, [
                        'class' => 'partner-service-gallery-dots',
                        'aria-hidden' => 'true',
                    ]);
                }

                $bodyContent = Html::tag('h3', Html::encode($model->name));

                $bodyContent .= Html::a('Подробнее', 'javascript::void(0)', ['class' => 'more']);

                return Html::tag('div', $imageContent, [
                        'class' => 'card-img partner-service-gallery',
                        'data-partner-service-gallery' => true,
                    ])
                    . Html::tag('div', $bodyContent, ['class' => 'card-body']);
            },
            'layout' => "{items}\n{pager}",
            'emptyText' => '',
        ]) ?>
    </div>
    <?= $this->render('_sidebar', ['activePage' => 'partners-services']) ?>
</div>

<section class="home-parallax partners-services-parallax" aria-label="Вместе — к новым победам">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">Вместе — к новым победам</h2>
    </div>
</section>
