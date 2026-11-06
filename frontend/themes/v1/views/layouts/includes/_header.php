<?php


/** @var \frontend\models\Contacts $contacts */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<header class="header">
    <div class="container bar">
        <a class="brand" href="/">
            <img class="logo" src="/images/static/logo.webp" width="56" height="56" alt="">
            <span class="brand-name">
                <?= Yii::$app->name; ?>
            </span>
        </a>
        <button class="burger" type="button" aria-controls="nav" aria-expanded="false">
            ☰ <?= Yii::t('app', 'Menu') ?>
        </button>
        <nav class="nav" id="nav" aria-label="Главное меню">
            <ul>
                <li>
                    <a href="<?= Url::toRoute('/history') ?>">
                        <?= Yii::t('app', 'History') ?>
                    </a>
                </li>
                <!-- <li class="has-sub">
                    <a href="/khronika/">
                        Хроника событий
                    </a>
                    <ul>
                        <li>
                            <a href="/khronika/karate/">
                                Всестилевое каратэ
                            </a>
                        </li>
                        <li>
                            <a href="/khronika/kikboksing/">
                                Кикбоксинг
                            </a>
                        </li>
                    </ul>
                </li> -->
                <li class="has-sub">
                    <a href="javascript::void(0);">
                        <?= Yii::t('app', 'Sponsors') ?>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= Url::toRoute('/sponsors') ?>">
                                <?= Yii::t('app', 'Our Partners') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/sponsors/proposal/') ?>">
                                <?= Yii::t('app', 'Proposal for sponsors') ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="has-sub">
                    <a href="/dokumentatsiya/">
                        Документация
                    </a>
                    <ul>
                        <li>
                            <a href="/dokumentatsiya/uchreditelnye/">
                                Учредительные документы
                            </a>
                        </li>
                        <li>
                            <a href="/dokumentatsiya/otdeleniya/">
                                Отделения по видам спорта
                            </a>
                        </li>
                        <li>
                            <a href="/dokumentatsiya/trenery/">
                                Для тренеров
                            </a>
                        </li>
                        <li>
                            <a href="/dokumentatsiya/sportsmeny/">
                                Для спортсменов
                            </a>
                        </li>
                        <li>
                            <a href="/dokumentatsiya/kalendar/">
                                Календарный план мероприятий
                            </a>
                        </li>
                        <li>
                            <a href="/dokumentatsiya/polozheniya/">
                                Положения по мероприятиям
                            </a>
                        </li>
                    </ul>
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
                <!-- <li class="has-sub">
                    <a href="/tovary-i-uslugi/">
                        Товары и услуги
                    </a>
                    <ul>
                        <li>
                            <a href="/tovary-i-uslugi/partnerskie-uslugi/">
                                Партнёрские услуги
                            </a>
                        </li>
                    </ul>
                </li> -->
            </ul>
            <address class="header-contacts">
                <?php foreach (array_unique(ArrayHelper::getColumn($contacts, 'address')) as $address): ?>
                    <?php if (trim((string) $address) !== ''): ?>
                    <span><?= Html::encode(trim($address)) ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php foreach (array_unique(ArrayHelper::getColumn($contacts, 'email')) as $email): ?>
                    <?php if (trim((string) $email) !== ''): ?>
                    <a href="mailto:<?= Html::encode(trim($email)) ?>">
                        <?= Html::encode(trim($email)) ?>
                    </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php foreach (array_unique(ArrayHelper::getColumn($contacts, 'phone')) as $phone): ?>
                    <?php if (trim((string) $phone) !== ''): ?>
                    <a href="tel:<?= Html::encode(preg_replace('/[^\d+]/', '', trim($phone))) ?>">
                        <?= Html::encode(trim($phone)) ?>
                    </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </address>
        </nav>
    </div>
</header>