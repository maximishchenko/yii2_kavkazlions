<?php

/** @var frontend\models\History $model */

use yii\helpers\Html;

?>
<?php if ($imageUrl = $model->getImageUrl()): ?>
    <div class="history-item__image">
        <a href="<?= Html::encode($imageUrl) ?>" data-fancybox="history" data-caption="<?= Html::encode($model->title) ?>">
            <picture>
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
