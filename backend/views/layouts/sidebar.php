<?php

use yii\helpers\Html;

/** @var string|false $assetDir */
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->homeUrl ?>" class="brand-link">
        <?= Html::img('/admin/static/images/lk_logo.webp', ['alt' => Yii::$app->name, 'class' => 'brand-image img-circle elevation-3']) ?>
        <span class="brand-text font-weight-light">
            <?= Yii::$app->name; ?>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?= \cebe\gravatar\Gravatar::widget([
                    'email' => Yii::$app->user->identity->email,
                    'options' => [
                    ],
                    'size' => 32
                ]) ?>
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <?= Yii::$app->user->identity->username; ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => Yii::t('app', 'MANAGEMENT_MODULE'), 'url' => ['/management/default/index'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger', 'visible' => true,],
                    ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content/default/index'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-success', 'visible' => true,],

                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>