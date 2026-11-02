<?php

declare(strict_types=1);

namespace backend\widgets;

use yii\base\Widget;

final class CollapsedAccordionWidget extends Widget
{
    public string $content;

    public string $title;

    public string $accordionId;

    public string $headerId;

    public string $collapseId;
    
    public function run()
    {
?>

    <div class="accordion" id="<?= $this->accordionId; ?>">

        <div class="accordion-item">
            <h2 class="accordion-header" id="<?= $this->headerId; ?>">
                <button class="accordion-button" type="button" data-toggle="collapse" data-target="#<?= $this->collapseId; ?>" aria-expanded="true" aria-controls="<?= $this->collapseId; ?>">
                    <strong>
                        <?= $this->title; ?>
                    </strong>
                </button>
            </h2>
            <div id="<?= $this->collapseId; ?>" class="accordion-collapse collapse show" aria-labelledby="<?= $this->headerId; ?>" data-parent="#<?= $this->accordionId; ?>">
                <div class="accordion-body">
                    <div class="row">
                        <?= $this->content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?
    }
}