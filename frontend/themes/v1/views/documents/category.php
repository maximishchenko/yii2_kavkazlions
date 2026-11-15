<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var frontend\models\DocumentsCategory $category */
/** @var yii\data\ActiveDataProvider $categories */
/** @var yii\data\ActiveDataProvider $documents */
/** @var frontend\models\DocumentsCategory[] $rootCategories */

$this->title = $category->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents Title'), 'url' => ['/documents/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title"><?= Html::encode($this->title) ?></h1>

<div class="layout">
<div class="content">
<?php if ($categories->getCount() > 0): ?>
    <?= ListView::widget([
        'dataProvider' => $categories,
        'itemView' => '_category',
        'layout' => '{items}',
        'options' => ['tag' => 'ul', 'class' => 'document-categories'],
        'itemOptions' => ['tag' => 'li', 'class' => 'sponsor-card'],
    ]) ?>
<?php endif; ?>
<?php if ($documents->getCount() > 0): ?>
    <h2 class="section-title"><?= Yii::t('app', 'Documents') ?></h2>
    <?= ListView::widget([
        'dataProvider' => $documents,
        'itemView' => static function ($model) {
            return Html::a(Html::encode($model->name), ['/documents/view', 'slug' => $model->slug]);
        },
        'layout' => '{items}',
        'options' => ['tag' => 'ul', 'class' => 'doc-list document-links'],
        'itemOptions' => ['tag' => 'li'],
    ]) ?>
<?php endif; ?>
</div>
<?= $this->render('_sidebar', ['rootCategories' => $rootCategories, 'category' => $category]) ?>
</div>
