<?php

/** @var yii\web\View $this */
/** @var backend\modules\content\models\PartnerServices $model */

$this->title = Yii::t('app', 'Create new record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-services-create">

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
