<?php

use backend\widgets\BaseActiveForm;
use backend\widgets\CollapsedAccordionWidget;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\Contacts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contacts-form">

    <?php $form = BaseActiveForm::begin([
        'id' => 'contacts-materials-form',
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
<?= $this->render('//layouts/forms/_buttons', ['formId' => 'contacts-materials-form']); ?>
