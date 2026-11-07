<?php

/** @var yii\web\View $this */
/** @var backend\modules\content\models\PartnerServices $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-services-update">

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
