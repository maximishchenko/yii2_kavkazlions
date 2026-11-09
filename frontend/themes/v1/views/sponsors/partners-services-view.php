<?php

use frontend\assets\FancyboxAsset;
use frontend\assets\SwiperAsset;
use frontend\models\PartnerServices;
use frontend\models\PartnerServicesImages;
use yii\helpers\Html;
/** @var mixed $sponsorsServices */
/** @var mixed $sponsorsBottomServices */

/** @var yii\web\View $this */
/** @var PartnerServices $model */

FancyboxAsset::register($this);
SwiperAsset::register($this);
$this->registerJs(<<<'JS'
Fancybox.bind("[data-fancybox]");
new Swiper('.partner-service-slider', {
    loop: true,
    pagination: {
        el: '.partner-service-slider .swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.partner-service-slider .swiper-button-next',
        prevEl: '.partner-service-slider .swiper-button-prev',
    },
});
JS, \yii\web\View::POS_END);

$this->title = Yii::t('app', 'Sponsors Partner Service Title {service}', ['service' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sponsors'), 'url' => ['/sponsors']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sponsors Partners Services'), 'url' => ['/sponsors/partners-services']];
$this->params['breadcrumbs'][] = $this->title;

$images = $model->partnerServicesImages;
?>
<h1 class="page-title">
    <?= Html::encode($this->title) ?>
</h1>
<section class="home-parallax partners-services-parallax">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">
            <?= $sponsorsServices ?>
        </h2>
    </div>
</section>

<div class="layout">
    <div class="content">
        <div class="leader-profile">
            <div class="leader-profile__photo">
                <?php if ($images): ?>
                    <div class="swiper partner-service-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($images as $image): ?>
                                <?php $imageUrl = '/' . PartnerServicesImages::UPLOAD_PATH . $image->image; ?>
                                <div class="swiper-slide">
                                    <a href="<?= $imageUrl ?>" data-fancybox="service-gallery" data-caption="<?= Html::encode($model->name) ?>">
                                        <?= Html::img($imageUrl, [
                                            'alt' => $model->name,
                                            'loading' => 'lazy',
                                        ]) ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (count($images) > 1): ?>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="avatar"></div>
                <?php endif; ?>
            </div>
            <div class="leader-profile__info">
                <?php if ($model->description): ?>
                    <div class="prose">
                        <?= Html::decode($model->description) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?= $this->render('_sidebar', ['activePage' => 'partners-services']) ?>
</div>


<section class="home-parallax partners-services-parallax">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">
            <?= $sponsorsBottomServices ?>
        </h2>
    </div>
</section>