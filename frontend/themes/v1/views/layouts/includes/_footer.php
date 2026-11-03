<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <?php

use yii\helpers\Url;

 if(Yii::$app->configManager->getItemValue('companySlogan')): ?>
                <div class="slogan">
                    <?= Yii::$app->configManager->getItemValue('companySlogan') ?>
                </div>
                <?php endif; ?>
                <?php if(Yii::$app->configManager->getItemValue('companyNameFull')): ?>
                <p>
                    <?= Yii::$app->configManager->getItemValue('companyNameFull') ?>
                </p>
                <?php endif; ?>
            </div>
            <div>
                <h4>
                    <?= Yii::t('app', 'Website sections') ?>
                </h4>
                <ul>
                    <!-- <li>
                        <a href="/istoriya/">
                            История
                        </a>
                    </li>
                    <li>
                        <a href="/khronika/">
                            Хроника событий
                        </a>
                    </li>
                    <li>
                        <a href="/rukovodstvo/">
                            Руководство
                        </a>
                    </li>
                    <li>
                        <a href="/sponsory/">
                            Спонсоры
                        </a>
                    </li>
                    <li>
                        <a href="/dokumentatsiya/">
                            Документация
                        </a>
                    </li> -->
                    <li>
                        <a href="<?= Url::toRoute('/management') ?>">
                            <?= Yii::t('app', 'Management Title') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute('/contacts') ?>">
                            <?= Yii::t('app', 'Contacts') ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h4>
                    <?= Yii::t('app', 'Contacts') ?>
                </h4>
                <ul>
                    <?php if(Yii::$app->configManager->getItemValue('contactAddress')): ?>
                    <li>
                        <?= Yii::$app->configManager->getItemValue('contactAddress') ?>
                    </li>
                    <?php endif; ?>

                    <?php if(Yii::$app->configManager->getItemValue('contactEmail')): ?>
                    <li>
                        <a href="mailto://<?= Yii::$app->configManager->getItemValue('contactEmail') ?>">
                            <?= Yii::$app->configManager->getItemValue('contactEmail') ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(Yii::$app->configManager->getItemValue('contactPhone')): ?>
                    <li>
                        <a href="tel:<?= Yii::$app->configManager->getItemValue('contactPhone') ?>">
                            <?= Yii::$app->configManager->getItemValue('contactPhone') ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
    </div>
    <div class="copy">
        <span>&copy; 2003–<?= date('Y') ?> <?= Yii::$app->configManager->getItemValue('companyName') ?></span>
    </div>
</footer>