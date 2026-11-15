<?php

use backend\modules\content\models\DocumentsAttach;
use yii\helpers\Html;

/** @var backend\modules\content\models\ManagementCompany $model */
/** @var backend\modules\content\models\DocumentsAttach $attachModel */
/** @var backend\widgets\BaseActiveForm $form */
?>
<div class="col-md-6">
<?= $form->field($attachModel, 'attachFile', ['template' => '{label}<br/> {input} {hint} {error}'])->fileInput() ?>
    <?php if(isset($attachModel->attach) && !empty($attachModel->attach)): ?>
        <div class="row">
            <div class='col-md-3' style="display: inline-block;">
                <?= Html::a(
                    '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8"/></svg>',
                    $attachModel->getUrl(DocumentsAttach::UPLOAD_PATH, $attachModel->attach),
                    ['target' => '_blank', 'rel' => 'noopener noreferrer', 'title' => $attachModel->attach, 'aria-label' => $attachModel->attach]
                ) ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="col-md-6">
    <?= $form->field($attachModel, 'comment')->textarea(['rows' => 6]) ?>
</div>