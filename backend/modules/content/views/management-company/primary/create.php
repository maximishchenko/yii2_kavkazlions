<?php


/** @var yii\web\View $this */
/** @var backend\modules\content\models\ManagementCompany $model */

$this->title = Yii::t('app', 'Create new record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Management Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="management-company-create">

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
