<?php

use backend\widgets\BaseActiveForm;
use backend\widgets\CollapsedAccordionWidget;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\ManagementLeader $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="management-leader-form">

    <div class="alert alert-warning">
        <ul>
            <li>
                <?= Yii::t('app', 'MANAGEMENT_LEADERS_NAME_IS_REQUIRED') ?>
            </li>
            <li>
                <?= Yii::t('app', 'MANAGEMENT_LEADERS_TITLE_IS_REQUIRED') ?>
            </li>
            <li>
                <?= Yii::t('app', 'MANAGEMENT_LEADERS_COMPANY_IS_REQUIRED') ?>
            </li>
            <li>
                <?= Yii::t('app', 'MANAGEMENT_LEADERS_DESCRIPTION_IS_OPTIONAL') ?>
            </li>
            <li>
                <?= Yii::t('app', 'SORT_IS_OPTIONAL_WITH_DEFAULT_VALUE') ?>
            </li>
            <li>
                <?= Yii::t('app', 'STATUS_IS_OPTIONAL_WITH_DEFAULT_VALUE') ?>
            </li>
            <li>
                <?= Yii::t('app', 'COMMENT_IS_OPTIONAL_AND_SERVICE') ?>
            </li>
            <li>
                <?= Yii::t('app', 'MANAGEMENT_IMAGE_REQUIREMENTS') ?>
            </li>
        </ul>
    </div>

    <?php $form = BaseActiveForm::begin([
        'id' => 'management-leaders-form',
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

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'management-leaders-form']); ?>