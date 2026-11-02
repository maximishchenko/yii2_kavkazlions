<?php

use backend\widgets\SaveFormButtonsWidget;

/** @var string $formId */

$this->beginBlock('buttons'); ?>
    <div class="form-group text-center">
        <?= SaveFormButtonsWidget::widget(['formId' => $formId]) ?>
    </div>
<?php $this->endBlock();  ?>