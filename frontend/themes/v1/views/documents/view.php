<?php

use frontend\models\DocumentsAttach;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/** @var yii\web\View $this */
/** @var frontend\models\Documents $document */
/** @var frontend\models\DocumentsCategory|null $category */
/** @var frontend\models\DocumentsCategory[] $rootCategories */

$this->title = $document->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents Title'), 'url' => ['/documents/index']];
if ($category !== null) {
    foreach ($category->breadcrumbLinks as $link) {
        $this->params['breadcrumbs'][] = $link;
    }
}
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title"><?= Html::encode($document->name) ?></h1>

<div class="layout">
<div class="content">
<?php if ($document->description): ?>
    <div class="prose"><?= HtmlPurifier::process(Html::decode($document->description)) ?></div>
<?php endif; ?>
<?php if ($document->attachments): ?>
    <h2 class="section-title"><?= Html::encode(Yii::t('app', 'Attachments')) ?></h2>
    <ul class="doc-list document-links attachment-links">
        <?php foreach ($document->attachments as $attachment): ?>
            <?php if ($attachment->attach): ?>
                <?php
                $extension = pathinfo($attachment->attach, PATHINFO_EXTENSION);
                $downloadName = $attachment->name . ($extension !== '' ? '.' . $extension : '');
                ?>
                <li>
                    <?= Html::beginTag('a', ['href' => '/' . DocumentsAttach::UPLOAD_PATH . rawurlencode($attachment->attach), 'download' => $downloadName]) ?>
                    <span class="doc-icon" aria-hidden="true">↓</span>
                    <div>
                        <?= Html::encode($attachment->name) ?>
                        <?php if ($attachment->description): ?>
                            <div class="prose"><?= HtmlPurifier::process(Html::decode($attachment->description), ['HTML.ForbiddenElements' => ['a']]) ?></div>
                        <?php endif; ?>
                    </div>
                    <?= Html::endTag('a') ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>
<?= $this->render('_sidebar', ['rootCategories' => $rootCategories, 'category' => $category]) ?>
</div>
