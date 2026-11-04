<?php

$this->title = Yii::t('app', 'Sponsors Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title">
    <?= $this->title ?>
</h1>

<section class="home-parallax sponsors-parallax" aria-label="<?= $this->title ?>">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">
            <?= Yii::t('app', 'Sponsors Index Parallax Slogan') ?>
        </h2>
    </div>
</section>

<section class="home-parallax sponsors-parallax" aria-label="<?= Yii::t('app', 'Sponsors Index Parallax Bottom Title') ?>">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">
            <?= Yii::t('app', 'Sponsors Index Parallax Bottom Title') ?>
        </h2>
        <p class="home-parallax-subtitle">
            <?= Yii::t('app', 'Sponsors Index Parallax Bottom Subtitle') ?>
        </p>
    </div>
</section>