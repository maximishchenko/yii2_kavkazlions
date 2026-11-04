<?php


/** @var yii\web\View $this */
/** @var backend\modules\content\models\ManagementCompany $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Management Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="management-company-update">

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
