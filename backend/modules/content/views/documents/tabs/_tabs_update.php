<?php

use backend\models\Tabs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\content\models\Documents $model */

?>

<ul class="nav nav-tabs admin__tabs" style="margin-bottom: 30px !important;">
  <li class="nav-item">
    <?= Html::a(Yii::t("app", "Documents"), ['update', 'id' => $model->id], ['class' => Tabs::isActionActive(['update'])]); ?>
  </li>
  <li class="nav-item">
    <?= Html::a(Yii::t("app", "Documents Attaches"), ['attaches', 'id' => $model->id], ['class' => Tabs::isActionActive(['attaches'])]); ?>
  </li>
</ul>