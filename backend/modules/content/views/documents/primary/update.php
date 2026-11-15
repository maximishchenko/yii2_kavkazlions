<?php

/** @var yii\web\View $this */
/** @var backend\modules\content\models\Documents $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-update">
    
    <?= $this->render('../tabs/_tabs_update', ['model' => $model]); ?>

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
