<?php
use yii\bootstrap5\Breadcrumbs;
?>

<?= Breadcrumbs::widget([
    'tag' => false,
    'homeLink' => ['label' => 'Главная', 'url' => '/'],
    'itemTemplate' => '{link}',
    'activeItemTemplate' => '<span>{link}</span>',
    'navOptions' => ['class' => 'breadcrumbs', 'aria-label' => 'Хлебные крошки'],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
