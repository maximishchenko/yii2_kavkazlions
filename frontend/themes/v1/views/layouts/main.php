<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\themes\v1\assets\AppAsset;
use yii\bootstrap5\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="home">
<?php $this->beginBody() ?>

<div class="home-loading" hidden aria-hidden="true">
    <div class="home-loading-indicator">
        <i class="home-loading-ring"></i>
        <i class="home-loading-ring"></i>
        <div class="home-loading-bars">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>

<?= $this->render('includes/_header') ?>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= $this->render('includes/_breadcrumbs') ?>
        <?= $content ?>
    </div>
</main>

<?= $this->render('includes/_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
