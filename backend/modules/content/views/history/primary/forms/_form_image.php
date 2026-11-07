<?php

use backend\widgets\SingleImagePreviewWidget;
use common\modules\content\models\History;

/** @var backend\modules\content\models\ManagementCompany $model */
/** @var backend\widgets\BaseActiveForm $form */
?>
<div class="col-md-12">
<?= $form->field($model, 'imageFile', ['template' => '{label}<br/> {input} {hint} {error}'])->fileInput() ?>
    <?php if(isset($model->image) && !empty($model->image)): ?>
        <div class="row">
            <?= SingleImagePreviewWidget::widget([
                'id' => $model->id,
                'filePath' => $model->getUrl(History::UPLOAD_PATH, $model->image),
                'url' => 'delete-image',
                'fancyboxGalleryName' => "SingleCategoryImage",
            ]); ?>
        </div>
    <?php endif; ?>
</div>