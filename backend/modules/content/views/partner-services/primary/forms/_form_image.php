<?php

use backend\modules\content\models\PartnerServicesImages;
use backend\widgets\SingleImagePreviewWidget;

/** @var backend\modules\content\models\ManagementCompany $model */
/** @var backend\widgets\BaseActiveForm $form */
?>

<div class="col-md-12">
    <?= $form->field($model, 'imagesFiles[]', ['template' => '{label}<br/> {input} {hint} {error}'])->fileInput(['multiple' => true]) ?>
</div>
<?php if(isset($model->partnerServicesImages) && !empty($model->partnerServicesImages)):?>
<ul style="margin: 0; padding: 0;">
    <div id="sortable" class="row" data-url="<?= Yii::$app->urlManager->createAbsoluteUrl('/content/partner-services/save-image-sort'); ?>">
        <?php foreach ($model->partnerServicesImages as $k => $image): ?>
            <?= SingleImagePreviewWidget::widget([
                'id' => $image->id,
                'filePath' => $model->getUrl(PartnerServicesImages::UPLOAD_PATH, $image->image),
                'url' => 'delete-image',
                'fancyboxGalleryName' => "SingleOfferImage",
            ]); ?>
        <?php endforeach; ?>
    </div>
</ul>
<?php endif; ?>