<?php
$this->title = Yii::t('app', 'Starter Page');
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">

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
                            <?= $this->renderFile('@backend/modules/management/views/default/_items.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

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
                            <?= $this->renderFile('@backend/modules/content/views/default/_items.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</div>