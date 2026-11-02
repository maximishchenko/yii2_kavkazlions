<?php

use backend\modules\management\models\Setting;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use backend\widgets\CollapsedAccordionWidget;

/** @var yii\web\View $this */
/** @var backend\modules\management\models\Setting $models **/
/** @var array $tabs **/

?>
<?php $form = ActiveForm::begin([
    'id' => 'settings-form'
]); ?>

<p class="text-right">
    <?= Html::a(Yii::t('app', 'Config Restore defaults'), ['default'], ['class' => 'btn btn-warning btn-sm', 'data-confirm' => Yii::t('app', 'Are you sure you want to restore default values?')]); ?>
</p>

<ul class="nav nav-tabs" id="settingsTabs" role="tablist">

    <?php foreach ($tabs as $k => $tab): ?>
        <li class="nav-item">
            <a class="nav-link <?= ($k == 0) ? 'active' : null; ?>" id="<?= $tab; ?>-tab" data-toggle="tab" href="#<?= $tab; ?>" role="tab" aria-controls="<?= $tab; ?>" aria-selected="true">
                <?= Setting::getTabsArray()[$tab]; ?>
            </a>
        </li>
    <?php endforeach; ?>

</ul>

<div class="tab-content" id="settingsTabsContent" style="margin-top: 50px;">

    <?php foreach ($tabs as $k => $tab): ?>
        <div class="tab-pane fade show <?= ($k == 0) ? 'active' : null; ?>" id="<?= $tab; ?>" role="tabpanel" aria-labelledby="<?= $tab; ?>-tab">
            <div class="row">
            
                <?= CollapsedAccordionWidget::widget([
                        'content' => $this->render('_form_settings', [
                            'form' => $form,
                            'models' => $models,
                            'tab' => $tab,
                        ]),
                        'title' => Setting::getTabsArray()[$tab],
                        'accordionId' => "backendAccordion-".$tab,
                        'headerId' => 'headerPrimary'.$tab,
                        'collapseId' => 'collapsePrimary'.$tab,
                ]) ?>

            </div>
        </div>
    <?php endforeach; ?>

</div>

<?php ActiveForm::end(); ?>


<?= $this->render('//layouts/forms/_buttons', ['formId' => 'settings-form']); ?>