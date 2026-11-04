<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var frontend\models\ManagementLeader $model */
/** @var frontend\models\ManagementCompany $company */
?>
<a href="<?= Url::toRoute(['/management/leader', 'companySlug' => $company->slug, 'slug' => $model->slug]) ?>">
    <?php if ($imageUrl = $model->getImageUrl()): ?>
        <picture>
            <?php if ($webpUrl = $model->getImageWebpUrl()): ?>
                <source srcset="<?= $webpUrl ?>" type="image/webp">
            <?php endif; ?>
            <?= Html::img($imageUrl, [
                'class' => 'avatar',
                'alt' => $model->name,
                'width' => 180,
                'height' => 180,
                'loading' => 'lazy',
            ]) ?>
        </picture>
    <?php else: ?>
        <div class="avatar"></div>
    <?php endif; ?>
    <h3><?= Html::encode($model->name) ?></h3>
    <?php if ($model->title): ?>
        <div class="role"><?= Html::encode($model->title) ?></div>
    <?php endif; ?>
    <?php if ($model->comment): ?>
        <p class="meta"><?= Html::encode($model->comment) ?></p>
    <?php endif; ?>
</a>
