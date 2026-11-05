<?php
$this->title = Yii::t('app', 'Starter Page');
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">

    <?= $this->renderFile('@backend/modules/management/views/default/_items.php'); ?>

    <?= $this->renderFile('@backend/modules/content/views/default/_items.php'); ?>

</div>