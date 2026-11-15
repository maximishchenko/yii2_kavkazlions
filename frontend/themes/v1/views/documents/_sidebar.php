<?php

use yii\helpers\Html;

/** @var frontend\models\DocumentsCategory[] $rootCategories */
/** @var frontend\models\DocumentsCategory|null $category */
?>
<aside class="sidebar">
    <div class="box">
        <h3><?= Html::encode(Yii::t('app', 'Documents Title')) ?></h3>
        <ul>
            <?php foreach ($rootCategories as $rootCategory): ?>
                <li>
                    <?= Html::a(
                        Html::encode($rootCategory->name),
                        ['/documents/category', 'slug' => $rootCategory->slug],
                        $category !== null && $rootCategory->id === $category->id ? ['class' => 'active', 'aria-current' => 'page'] : []
                    ) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>
