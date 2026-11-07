<?php
use vova07\imperavi\Widget;
use yii\helpers\Url;

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
                'imageUpload' => Url::to(['/content/materials/image-upload']),
                'fileUpload' => Url::to(['/content/materials/file-upload']),
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'imagemanager',
                    'filemanager',
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