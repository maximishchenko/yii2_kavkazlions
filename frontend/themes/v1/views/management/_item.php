<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var frontend\models\ManagementCompany $model */
?>
<a href="<?= Url::toRoute(['/management/' . $model->slug]) ?>">
    <?php if ($imageUrl = $model->getImageUrl()): ?>
        <picture>
            <?php if ($webpUrl = $model->getImageWebpUrl()): ?>
                <source srcset="<?= $webpUrl ?>" type="image/webp">
            <?php endif; ?>
            <?= Html::img($imageUrl, [
                'class' => 'avatar',
                'alt' => $model->name,
                'width' => 120,
                'height' => 120,
                'loading' => 'lazy',
            ]) ?>
        </picture>
    <?php else: ?>
        <div class="avatar"></div>
    <?php endif; ?>
    <h3>
        <?= Html::encode($model->name) ?>
    </h3>
</a>