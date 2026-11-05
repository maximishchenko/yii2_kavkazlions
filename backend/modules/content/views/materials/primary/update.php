<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\Materials $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materials-update">

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
