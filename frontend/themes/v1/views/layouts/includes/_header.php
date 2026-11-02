<?php

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
                <!-- <li>
                    <a href="/istoriya/">
                        История
                    </a>
                </li> -->
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
                <!-- <li class="has-sub">
                    <a href="/rukovodstvo/">
                        Руководство
                    </a>
                    <ul>
                        <li>
                            <a href="/rukovodstvo/shkola/">
                                Руководство «Львы Кавказа» СК
                            </a>
                        </li>
                        <li>
                            <a href="/rukovodstvo/fvkr/">
                                Руководство ФВКР
                            </a>
                        </li>
                        <li>
                            <a href="/rukovodstvo/fkr/">
                                Руководство ФКР
                            </a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="has-sub">
                    <a href="/sponsory/">
                        Спонсоры
                    </a>
                    <ul>
                        <li>
                            <a href="/sponsory/partnery/">
                                Наши партнёры
                            </a>
                        </li>
                        <li>
                            <a href="/sponsory/predlozheniya/">
                                Предложения для спонсоров
                            </a>
                        </li>
                    </ul>
                </li> -->
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
                <?php if(Yii::$app->configManager->getItemValue('contactAddress')): ?>
                <span>
                    <?= Yii::$app->configManager->getItemValue('contactAddress') ?>
                </span>
                <?php endif; ?>
                <?php if(Yii::$app->configManager->getItemValue('contactEmail')): ?>
                <a href="mailto:<?= Yii::$app->configManager->getItemValue('contactEmail') ?>">
                    <?= Yii::$app->configManager->getItemValue('contactEmail') ?>
                </a>
                <?php endif; ?>
                <?php if(Yii::$app->configManager->getItemValue('contactPhone')): ?>
                <a href="tel:<?= Yii::$app->configManager->getItemValue('contactPhone'); ?>">
                    <?= Yii::$app->configManager->getItemValue('contactPhone'); ?>
                </a>
                <?php endif; ?>
            </address>
        </nav>
    </div>
</header>