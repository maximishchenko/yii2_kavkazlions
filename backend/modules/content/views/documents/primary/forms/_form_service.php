<?php

/** @var backend\modules\content\models\ManagementCompany $model */

use yii\widgets\DetailView;

/** @var backend\widgets\BaseActiveForm $form */
?>
<div class="col-md-12">
    
    <div class="alert alert-warning">
        <?= Yii::t('app', 'MANAGEMENT_HISTORY_SERVCIE_ADDITIONAL_HINT') ?>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'slug',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'createdByUser.username',
                'label' => $model->getAttributeLabel('created_by'),
            ],
            [
                'attribute' => 'updatedByUser.username',
                'label' => $model->getAttributeLabel('updated_by'),
            ],
        ],
    ]); ?>
</div>