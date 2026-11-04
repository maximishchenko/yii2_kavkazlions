<?php

/** @var yii\web\View $this */

$this->title = Yii::t('app', 'CONTENT_MODULE');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-default-index">
    <?= $this->render('_items'); ?>
</div>
