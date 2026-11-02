<?php

declare(strict_types=1);

namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

final class SaveFormButtonsWidget extends Widget
{
    /**
     * ID формы
     *
     * @var string $formId
     */
    public $formId;

    public function init()
    {
        parent::init();
        if ($this->formId === null) {
            $this->formId = 'frm';
        }
    }

    public function run()
    {
        echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-sm', 'form' => $this->formId]);
        echo Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-danger btn-sm', 'style' => "margin-left: 10px"]);
    }
}