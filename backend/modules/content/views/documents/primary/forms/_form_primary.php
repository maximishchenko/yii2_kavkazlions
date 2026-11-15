<?php
use vova07\imperavi\Widget;
use yii\helpers\Url;

/** @var backend\modules\content\models\ManagementCompany $model */
/** @var backend\widgets\BaseActiveForm $form */
?>
<div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'category_id')->dropDownList($model->getCategoriesItems(), ['prompt' => '-']) ?>

    <?= $form->field($model, 'sort')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    <?= $form->field($model, 'status')->checkbox() ?>
</div>
<div class="col-md-6">
    <?php
        echo $form->field($model, 'description')->widget(Widget::class, [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'imageUpload' => Url::to(['/content/documents/image-upload']),
                'fileUpload' => Url::to(['/content/documents/file-upload']),
                'plugins' => [
                    'table',
                    'fullscreen',
                    'formatting',
                    'imagemanager',
                    'filemanager',
                    'fontcolor',
                ],
                'formatting' => ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            ],
        ]);
    ?>
    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
</div>
