<?php
use vova07\imperavi\Widget;

/** @var backend\modules\content\models\ManagementLeader $model */
/** @var backend\widgets\BaseActiveForm $form */
?>
<div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sort')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    <?= $form->field($model, 'status')->checkbox() ?>
</div>
<div class="col-md-6">
    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
</div>
<div class="col-md-12">
    <?php
        echo $form->field($model, 'text')->widget(Widget::class, [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen',
                ],
                'clips' => [
                    ['Lorem ipsum...', 'Lorem...'],
                    ['red', '<span class="label-red">red</span>'],
                    ['green', '<span class="label-green">green</span>'],
                    ['blue', '<span class="label-blue">blue</span>'],
                ],
            ],
        ]);
    ?>
</div>