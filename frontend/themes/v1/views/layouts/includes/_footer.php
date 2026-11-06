<?php


/** @var \frontend\models\Contacts $contacts */

use frontend\widgets\MaterialsBlock;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>

                <div class="slogan">
                    <?= MaterialsBlock::widget(['id' => Yii::$app->configManager->getItemValue('templateFooterSloganID')]) ?>
                </div>
                <p>
                    <?= MaterialsBlock::widget(['id' => Yii::$app->configManager->getItemValue('templateCompanyFullNameID')]) ?>
                </p>
            </div>
            <div>
                <h4>
                    <?= Yii::t('app', 'Website sections') ?>
                </h4>
                <ul>
                    <li>
                        <a href="<?= Url::toRoute('/history') ?>">
                            <?= Yii::t('app', 'History') ?>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="/khronika/">
                            Хроника событий
                        </a>
                    </li>
                    <li>
                        <a href="/dokumentatsiya/">
                            Документация
                        </a>
                    </li> -->
                    <li>
                        <a href="<?= Url::toRoute('/sponsors') ?>">
                            <?= Yii::t('app', 'Sponsors') ?>
                        </a>
                    </li>
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
                    <?php foreach (array_unique(ArrayHelper::getColumn($contacts, 'address')) as $address): ?>
                        <?php if (trim((string) $address) !== ''): ?>
                        <li><?= Html::encode(trim($address)) ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php foreach (array_unique(ArrayHelper::getColumn($contacts, 'email')) as $email): ?>
                        <?php if (trim((string) $email) !== ''): ?>
                        <li>
                            <a href="mailto:<?= Html::encode(trim($email)) ?>">
                                <?= Html::encode(trim($email)) ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php foreach (array_unique(ArrayHelper::getColumn($contacts, 'phone')) as $phone): ?>
                        <?php if (trim((string) $phone) !== ''): ?>
                        <li>
                            <a href="tel:<?= Html::encode(preg_replace('/[^\d+]/', '', trim($phone))) ?>">
                                <?= Html::encode(trim($phone)) ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
    </div>
    <div class="copy">
        <span>&copy; 2003–<?= date('Y') ?> <?= Yii::$app->configManager->getItemValue('companyName') ?></span>
    </div>
</footer>