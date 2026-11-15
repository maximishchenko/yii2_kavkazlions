<?php

use yii\helpers\Html;

/** @var frontend\models\DocumentsCategory $model */
?>
<?= Html::beginTag('a', ['href' => \yii\helpers\Url::to(['/documents/category', 'slug' => $model->slug]), 'class' => 'document-category-link']) ?>
<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
    <path d="M4 10a3 3 0 0 1 3-3h8l3 4h15a3 3 0 0 1 3 3v15a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4V10Z" fill="var(--brand)"/>
    <path d="M4 17h32v12a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4V17Z" fill="white" fill-opacity=".16"/>
    <path d="M11 23h18M11 27h12" stroke="white" stroke-width="2" stroke-linecap="round"/>
</svg>
<span class="sponsor-card-name"><?= Html::encode($model->name) ?></span>
<?= Html::endTag('a') ?>
