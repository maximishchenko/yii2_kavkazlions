<?php

/** @var yii\web\View $this */
/** @var backend\modules\content\models\Documents $model */
/** @var backend\modules\content\models\DocumentsAttach $attachModel */

$this->title = Yii::t('app', 'Create new attach record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents Attaches'), 'url' => ['attaches', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-create">

    <?= $this->render('forms/_form', [
        'model' => $model,
        'attachModel' => $attachModel,
    ]) ?>

</div>
