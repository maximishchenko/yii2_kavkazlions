<?php

/** @var yii\web\View $this */
/** @var mixed $sponsorsProposal */
/** @var mixed $sponsorsBottomProposal */

$this->title = Yii::t('app', 'Sponsors Proposal Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title">
    <?= $this->title ?>
</h1>

<section class="home-parallax sponsors-parallax" aria-label="<?= $this->title ?>">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">
            <?= Yii::t('app', 'Sponsors Parallax Slogan') ?>
        </h2>
    </div>
</section>

<?php if ($sponsorsProposal): ?>
    <div class="prose">
        <?= $sponsorsProposal ?>
    </div>
<?php endif; ?>

<section class="home-parallax sponsors-parallax" aria-label="<?= $this->title ?>">
    <div class="home-parallax-overlay"></div>
    <div class="home-parallax-content">
        <h2 class="home-parallax-title">
            <?= $sponsorsBottomProposal ?>
        </h2>
    </div>
</section>
