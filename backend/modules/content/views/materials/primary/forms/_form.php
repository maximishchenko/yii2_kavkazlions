<?php

use backend\widgets\BaseActiveForm;
use backend\widgets\CollapsedAccordionWidget;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\Materials $model */
/** @var BaseActiveForm $form */
?>

<div class="materials-form">

    <div class="alert alert-warning">
        <?= Yii::t('app', 'MATERIALS_INDEX_HINT') ?>
    </div>
    
    <?php $form = BaseActiveForm::begin([
        'id' => 'content-materials-form',
    ]); ?>
    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>

    <?= CollapsedAccordionWidget::widget([
            'content' => $this->render('_form_primary', [
                'form' => $form,
                'model' => $model,
            ]),
            'title' => Yii::t('app', 'Primary block'),
            'accordionId' => 'backendAccordion',
            'headerId' => 'headerPrimary',
            'collapseId' => 'collapsePrimary',
    ]) ?>

    <?php BaseActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'content-materials-form']); ?>