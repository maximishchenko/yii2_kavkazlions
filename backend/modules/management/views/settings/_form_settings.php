<?php

use backend\modules\management\models\Setting;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/** @var backend\modules\management\models\Setting $models **/
/** @var \yii\widgets\ActiveForm $form **/
/** @var string $tab **/

?>
<?php foreach ($models as $key => $model): ?>
    <?php if (in_array($model->path, Setting::getTabsItems()[$tab])): ?>
    
        <div class="col-md-4">

            <?php
            $field = $form->field($model, "[{$key}]value")->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
            $inputType = ArrayHelper::remove($model->inputOptions, 'type');
            switch($inputType) {
                case 'phone':
                    $field->widget(\yii\widgets\MaskedInput::class, [
                        'mask' => '+7 (999) 999-99-99',
                    ])->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
                    break;
                case 'checkbox':
                    $field->checkbox()->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
                    break;
                case 'textarea':
                    $field->textarea()->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
                    break;
                case 'dropDown':
                    $field->dropDownList($model->inputOptions['items'])->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
                    break;
            }
            echo $field;
            ?>
        
        </div>

    <?php endif; ?>
<?php endforeach;?>
