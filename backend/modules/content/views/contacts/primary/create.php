<?php

/** @var yii\web\View $this */
/** @var backend\modules\content\models\Contacts $model */

$this->title = Yii::t('app', 'Create new record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create">

    <?= $this->render('forms/_form', [
        'model' => $model,
    ]) ?>

</div>
