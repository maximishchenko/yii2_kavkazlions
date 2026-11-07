<?php

/** @var yii\web\View $this */
/** @var backend\modules\content\models\History $model */

$this->title = Yii::t('app', 'Create new record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-create">

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
