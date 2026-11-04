<?php

use backend\modules\content\models\ManagementCompany;
use backend\widgets\SingleImagePreviewWidget;

/** @var backend\modules\content\models\ManagementCompany $model */
/** @var backend\widgets\BaseActiveForm $form */
?>
<div class="col-md-6">
<?= $form->field($model, 'imageFile', ['template' => '{label}<br/> {input} {hint} {error}'])->fileInput() ?>
    <?php if(isset($model->image) && !empty($model->image)): ?>
        <div class="row">
            <?= SingleImagePreviewWidget::widget([
                'id' => $model->id,
                'filePath' => $model->getUrl(ManagementCompany::UPLOAD_PATH, $model->image),
                'url' => 'delete-image',
                'fancyboxGalleryName' => "SingleCategoryImage",
            ]); ?>
        </div>
    <?php endif; ?>
</div>
<div class="col-md-6">
<?= $form->field($model, 'backgroundImageFile', ['template' => '{label}<br/> {input} {hint} {error}'])->fileInput() ?>
    <?php if(isset($model->backgroundImage) && !empty($model->backgroundImage)): ?>
        <div class="row">
            <?= SingleImagePreviewWidget::widget([
                'id' => $model->id,
                'filePath' => $model->getUrl(ManagementCompany::UPLOAD_PATH, $model->backgroundImage),
                'url' => 'delete-background-image',
                'fancyboxGalleryName' => "SingleCategoryBackgroundImage",
            ]); ?>
        </div>
    <?php endif; ?>
</div>