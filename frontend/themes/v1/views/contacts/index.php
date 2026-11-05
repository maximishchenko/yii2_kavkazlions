<?php

/** @var yii\web\View $this */

use frontend\models\Contacts;

/** @var string $contactsParallaxTitle */
/** @var string $contactsParallaxSubTitle */
/** @var Contacts | array $contacts */

$this->title = Yii::t('app', 'Contact Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title">
    <?= $this->title ?>
</h1>


<div class="layout full">
    <div class="content">
        <div class="contact-grid">
            <?php if ($contacts): ?>
            <div class="contact-card">
                <h3>
                    <?= Yii::t('app', 'Addresses') ?>
                </h3>
                <p>
                    <?= implode(', ', array_map(static function ($address) {
                        return \yii\helpers\Html::encode(trim($address));
                    }, \yii\helpers\ArrayHelper::getColumn($contacts, 'address'))) ?>
                </p>
            </div>
            <?php endif; ?>
            <div class="contact-card">
                <h3>
                    <?= Yii::t('app', 'Contacts Block') ?>
                </h3>
                <?php if ($contacts): ?>
                <p>
                    <?= Yii::t('app', 'Phone Word') ?>
                    <?= implode(', ', array_map(static function ($phone) {
                        $phone = trim($phone);
                        $phoneLink = preg_replace('/[^\d+]/', '', $phone);

                        return \yii\helpers\Html::a(
                            \yii\helpers\Html::encode($phone),
                            'tel:' . $phoneLink
                        );
                    }, array_unique(\yii\helpers\ArrayHelper::getColumn($contacts, 'phone')))) ?>
                </p>
                <?php endif; ?>
                <?php if ($contacts): ?>
                <p>
                    <?= Yii::t('app', 'Email Word') ?>
                    <?= implode(', ', array_map(static function ($email) {
                        $email = trim($email);

                        return \yii\helpers\Html::a(
                            \yii\helpers\Html::encode($email),
                            'mailto:' . $email
                        );
                    }, array_unique(\yii\helpers\ArrayHelper::getColumn($contacts, 'email')))) ?>
                </p>
                <?php endif; ?>
            </div>
            <div class="contact-card">
                <h3>
                    <?= Yii::t('app', 'We are in socials') ?>
                </h3>
                <ul class="socials">
                    <?php if(Yii::$app->configManager->getItemValue('socialsVk')): ?>
                    <li>
                        <a href="<?= Yii::$app->configManager->getItemValue('socialsVk') ?>" target="_blank">
                            <svg class="icon" viewBox="0 0 17 17" aria-hidden="true">
                                <use xlink:href="/images/sprites/sprite.svg#vk"></use>
                            </svg>
                            ВКонтакте
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(Yii::$app->configManager->getItemValue('socialsMax')): ?>
                    <li>
                        <a href="<?= Yii::$app->configManager->getItemValue('socialsMax') ?>" target="_blank">
                            <svg class="icon" viewBox="0 0 17 17" aria-hidden="true">
                                <use xlink:href="/images/sprites/sprite.svg#max"></use>
                            </svg>
                            MAX
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>


        <section class="contacts-parallax">
            <div class="contacts-parallax-overlay"></div>
            <div class="contacts-parallax-content">
                <?php if ($contactsParallaxTitle): ?>
                <h2 class="contacts-parallax-title">
                    <?= $contactsParallaxTitle ?>
                </h2>
                <?php endif; ?>
                <?php if ($contactsParallaxSubTitle): ?>
                <p class="contacts-parallax-subtitle">
                    <?= $contactsParallaxSubTitle ?>
                </p>
                <?php endif; ?>
            </div>
        </section>

        <div class="map-ph" data-longitude="<?= Yii::$app->configManager->getItemValue('companyPositionLng') ?>" data-latitude="<?= Yii::$app->configManager->getItemValue('companyPositionLtd') ?>" data-maps-api-key="<?= Yii::$app->configManager->getItemValue('mapApiKey') ?>" data-hint-name="<?= \yii\helpers\Html::encode(trim(preg_replace('/\s+/', ' ', strip_tags(Yii::$app->name)))) ?>" data-hint-address="<?= \yii\helpers\Html::encode(Yii::$app->configManager->getItemValue('contactAddress')) ?>" data-hint-phone="<?= \yii\helpers\Html::encode(Yii::$app->configManager->getItemValue('contactPhone')) ?>" data-hint-email="<?= \yii\helpers\Html::encode(Yii::$app->configManager->getItemValue('contactEmail')) ?>">
            <?= Yii::t('app', 'Map was here') ?>
        </div>
    </div>

</div>