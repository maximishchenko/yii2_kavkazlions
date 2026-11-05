<?php

use yii\helpers\Url;
use hail812\adminlte\widgets\SmallBox;
?>

    <div class="accordion" id="managementAccordion">

        <div class="accordion-item">
            <h2 class="accordion-header" id="managementHeaderPrimary">
                <button class="accordion-button" type="button" data-toggle="collapse" data-target="#managementCollapsePrimary" aria-expanded="true" aria-controls="managementCollapsePrimary">
                    <strong>
                        <h1><?= Yii::t('app', 'MANAGEMENT_MODULE'); ?></h1>
                    </strong>
                </button>
            </h2>
            <div id="managementCollapsePrimary" class="accordion-collapse collapse show" aria-labelledby="managementHeaderPrimary" data-parent="#managementAccordion">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <?= SmallBox::widget([
                                        'title' => Yii::t('app', 'SETTINGS'),
                                        'text' => Yii::t('app', 'SETTINGS Edit'),
                                        'icon' => 'fas fa-cog',
                                        'theme' => 'danger',
                                        'linkText' => Yii::t('app', 'GO_LINK'),
                                        'linkUrl' => Url::to(['/management/settings'])
                                    ]) ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>