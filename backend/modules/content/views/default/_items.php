<?php

use yii\helpers\Url;
use hail812\adminlte\widgets\SmallBox;
?>
<div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'MANAGEMENT_COMPANIES'),
                'text' => Yii::t('app', 'MANAGEMENT_COMPANIES Edit'),
                'icon' => 'fas fa-users',
                'theme' => 'success',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/management-company'])
            ]) ?>
        </div>
</div>