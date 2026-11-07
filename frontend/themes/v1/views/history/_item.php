<?php

/** @var frontend\models\History $model */

use yii\helpers\Html;

?>
<?php if ($imageUrl = $model->getImageUrl()): ?>
    <div class="history-item__image">
        <?= Html::img($imageUrl, [
            'class' => 'history-item__background',
            'alt' => '',
            'aria-hidden' => 'true',
            'loading' => 'lazy',
        ]) ?>
        <a href="<?= Html::encode($imageUrl) ?>" data-fancybox="history" data-caption="<?= Html::encode($model->title) ?>">
            <picture class="history-item__picture">
                <?php if ($webpUrl = $model->getImageWebpUrl()): ?>
                    <source srcset="<?= Html::encode($webpUrl) ?>" type="image/webp">
                <?php endif; ?>
                <?= Html::img($imageUrl, [
                    'alt' => $model->title ?: $model->name,
                    'loading' => 'lazy',
                ]) ?>
            </picture>
        </a>
    </div>
<?php endif; ?>
<div class="history-item__content prose">
    <?php if ($model->title): ?>
        <h2 class="history-item__title"><?= Html::encode($model->title) ?></h2>
    <?php endif; ?>
    <?= Html::decode($model->description) ?>
</div>
