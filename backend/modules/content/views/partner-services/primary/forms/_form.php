<?php

use backend\widgets\BaseActiveForm;
use backend\widgets\CollapsedAccordionWidget;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\PartnerServices $model */
/** @var BaseActiveForm $form */
?>

<div class="partner-services-form">

    <?php $form = BaseActiveForm::begin([
        'id' => 'partner-services-form',
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
    <?= CollapsedAccordionWidget::widget([
            'content' => $this->render('_form_image', [
                'form' => $form,
                'model' => $model,
            ]),
            'title' => Yii::t('app', 'Image block'),
            'accordionId' => 'backendAccordionImage',
            'headerId' => 'headerImage',
            'collapseId' => 'collapseImage',
    ]) ?>
    <?php if(!$model->isNewRecord): ?>
    <?= CollapsedAccordionWidget::widget([
            'content' => $this->render('_form_service', [
                'form' => $form,
                'model' => $model,
            ]),
            'title' => Yii::t('app', 'Service block'),
            'accordionId' => 'backendAccordionService',
            'headerId' => 'headerService',
            'collapseId' => 'collapseService',
    ]) ?>
    <?php endif; ?>

    <?php BaseActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'partner-services-form']); ?>