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

        <?php
        $mapPoints = [];
        foreach ($contacts as $contact) {
            if (!is_numeric($contact->latitude) || !is_numeric($contact->longitude)) {
                continue;
            }

            $mapPoints[] = [
                'latitude' => (float) $contact->latitude,
                'longitude' => (float) $contact->longitude,
                'name' => $contact->name,
                'address' => $contact->address,
                'phone' => $contact->phone,
                'email' => $contact->email,
            ];
        }
        ?>
        <div class="map-ph" data-maps-api-key="<?= Yii::$app->configManager->getItemValue('mapApiKey') ?>" data-points="<?= \yii\helpers\Html::encode(\yii\helpers\Json::encode($mapPoints)) ?>">
            <?= Yii::t('app', 'Map was here') ?>
        </div>
    </div>

</div>