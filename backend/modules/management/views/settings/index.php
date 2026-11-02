<?php

/** @var yii\web\View $this */
/** @var backend\modules\management\models\Setting $models **/
/** @var array $tabs **/

$this->title = Yii::t('app', 'SETTINGS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MANAGEMENT_MODULE'), 'url' => ['/management']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', ['models' => $models, 'tabs' => $tabs]); ?>