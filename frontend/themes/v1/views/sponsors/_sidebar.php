<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $activePage */

$links = [
    'index' => [Yii::t('app', 'Our Partners'), ['/sponsors/index']],
    'proposal' => [Yii::t('app', 'Proposal for sponsors'), ['/sponsors/proposal']],
    'partners-services' => [Yii::t('app', 'Sponsors Partners Services'), ['/sponsors/partners-services']],
];
?>
<aside class="sidebar">
    <div class="box">
        <h3><?= Yii::t('app', 'Sponsors') ?></h3>
        <ul>
            <?php foreach ($links as $page => [$label, $route]): ?>
                <li>
                    <?= Html::a($label, $route, $page === $activePage ? [
                        'class' => 'active',
                        'aria-current' => 'page',
                    ] : []) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>
