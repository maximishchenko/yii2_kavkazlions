<?php

use backend\widgets\BaseActiveForm;
use backend\widgets\CollapsedAccordionWidget;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\Documents $model */
/** @var backend\modules\content\models\DocumentsAttach $attachModel */
/** @var backend\widgets\BaseActiveForm $form */
?>

<div class="documents-attaches-form">

    <?= $this->render('../../tabs/_tabs_update', ['model' => $model]); ?>

    <?php $form = BaseActiveForm::begin([
        'id' => 'documents-attaches-form',
    ]); ?>
    <?= $form->errorSummary($attachModel, ['class' => 'alert alert-danger']); ?>

    <?= CollapsedAccordionWidget::widget([
            'content' => $this->render('_form_primary', [
                'form' => $form,
                'attachModel' => $attachModel,
            ]),
            'title' => Yii::t('app', 'Primary block'),
            'accordionId' => 'backendAccordion',
            'headerId' => 'headerPrimary',
            'collapseId' => 'collapsePrimary',
    ]) ?>

    <?= CollapsedAccordionWidget::widget([
            'content' => $this->render('_form_attach', [
                'form' => $form,
                'attachModel' => $attachModel,
            ]),
            'title' => Yii::t('app', 'Attach block'),
            'accordionId' => 'backendAccordionAttach',
            'headerId' => 'headerAttach',
            'collapseId' => 'collapseAttach',
    ]) ?>

    <?php BaseActiveForm::end(); ?>

</div>
<?= $this->render('//layouts/forms/_buttons', ['formId' => 'documents-attaches-form']); ?>
