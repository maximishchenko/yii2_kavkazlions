<?php

use yii\helpers\Url;
use hail812\adminlte\widgets\SmallBox;
?>

    <div class="accordion" id="contentAccordion">

        <div class="accordion-item">
            <h2 class="accordion-header" id="contentHeaderPrimary">
                <button class="accordion-button" type="button" data-toggle="collapse" data-target="#contentCollapsePrimary" aria-expanded="true" aria-controls="contentCollapsePrimary">
                    <strong>
                        <h1><?= Yii::t('app', 'CONTENT_MODULE'); ?></h1>
                    </strong>
                </button>
            </h2>
            <div id="contentCollapsePrimary" class="accordion-collapse collapse show" aria-labelledby="contentHeaderPrimary" data-parent="#contentAccordion">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <?= SmallBox::widget([
                                        'title' => Yii::t('app', 'MATERIALS'),
                                        'text' => Yii::t('app', 'MATERIALS Edit'),
                                        'icon' => 'fas fa-pen',
                                        'theme' => 'success',
                                        'linkText' => Yii::t('app', 'GO_LINK'),
                                        'linkUrl' => Url::to(['/content/materials'])
                                    ]) ?>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <?= SmallBox::widget([
                                        'title' => Yii::t('app', 'MANAGEMENT_COMPANIES'),
                                        'text' => Yii::t('app', 'MANAGEMENT_COMPANIES Edit'),
                                        'icon' => 'fas fa-building',
                                        'theme' => 'success',
                                        'linkText' => Yii::t('app', 'GO_LINK'),
                                        'linkUrl' => Url::to(['/content/management-company'])
                                    ]) ?>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <?= SmallBox::widget([
                                        'title' => Yii::t('app', 'MANAGEMENT_LEADERS'),
                                        'text' => Yii::t('app', 'MANAGEMENT_LEADERS Edit'),
                                        'icon' => 'fas fa-users',
                                        'theme' => 'success',
                                        'linkText' => Yii::t('app', 'GO_LINK'),
                                        'linkUrl' => Url::to(['/content/management-leader'])
                                    ]) ?>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <?= SmallBox::widget([
                                        'title' => Yii::t('app', 'CONTACTS'),
                                        'text' => Yii::t('app', 'CONTACTS Edit'),
                                        'icon' => 'fas fa-map',
                                        'theme' => 'success',
                                        'linkText' => Yii::t('app', 'GO_LINK'),
                                        'linkUrl' => Url::to(['/content/contacts'])
                                    ]) ?>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <?= SmallBox::widget([
                                        'title' => Yii::t('app', 'PARTNERS'),
                                        'text' => Yii::t('app', 'PARTNERS Edit'),
                                        'icon' => 'fas fa-users',
                                        'theme' => 'success',
                                        'linkText' => Yii::t('app', 'GO_LINK'),
                                        'linkUrl' => Url::to(['/content/partners'])
                                    ]) ?>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <?= SmallBox::widget([
                                        'title' => Yii::t('app', 'HISTORY'),
                                        'text' => Yii::t('app', 'HISTORY Edit'),
                                        'icon' => 'fas fa-book',
                                        'theme' => 'success',
                                        'linkText' => Yii::t('app', 'GO_LINK'),
                                        'linkUrl' => Url::to(['/content/history'])
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
