<?php

/** @var yii\web\View $this */
/** @var backend\modules\content\models\DocumentsCategory $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-category-update">

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
