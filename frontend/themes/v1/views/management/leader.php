<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\FancyboxAsset;

/** @var frontend\models\ManagementLeader $model */
/** @var frontend\models\ManagementCompany $company */

FancyboxAsset::register($this);
$this->registerJs('Fancybox.bind("[data-fancybox]");', \yii\web\View::POS_END);

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Management Title'), 'url' => ['/management']];
$this->params['breadcrumbs'][] = ['label' => $company->name, 'url' => ['/management/view', 'slug' => $company->slug]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title">
    <?= Html::encode($this->title) ?>
</h1>

<div class="leader-profile">
    <div class="leader-profile__photo">
        <?php if ($imageUrl = $model->getImageUrl()): ?>
            <a href="<?= $imageUrl ?>" data-fancybox="leader-photo" data-caption="<?= Html::encode($model->name) ?>">
                <picture>
                    <?php if ($webpUrl = $model->getImageWebpUrl()): ?>
                        <source srcset="<?= $webpUrl ?>" type="image/webp">
                    <?php endif; ?>
                    <?= Html::img($imageUrl, [
                        'alt' => $model->name,
                        'loading' => 'lazy',
                    ]) ?>
                </picture>
            </a>
        <?php else: ?>
            <div class="avatar"></div>
        <?php endif; ?>
    </div>
    <div class="leader-profile__info">
        <?php if ($model->title): ?>
            <div class="role"><?= Html::encode($model->title) ?></div>
        <?php endif; ?>
        <p class="leader-profile__company">
            <a href="<?= Url::toRoute(['/management/view', 'slug' => $company->slug]) ?>">
                <?= Html::encode($company->name) ?>
            </a>
        </p>
        <?php if ($model->description): ?>
            <div class="prose">
                <?= Html::decode($model->description) ?>
            </div>
        <?php endif; ?>
    </div>
</div>
