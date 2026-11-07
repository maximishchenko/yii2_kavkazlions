<?php


/** @var yii\web\View $this */
/** @var backend\modules\content\models\History $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-update">

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
