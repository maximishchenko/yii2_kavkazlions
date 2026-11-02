<?php

/** @var yii\web\View $this */

$this->title = Yii::t('app', 'MANAGEMENT_MODULE');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="management-default-index">
    <?= $this->render('_items'); ?>
</div>
