<?php

declare(strict_types=1);

namespace backend\widgets;

use yii\bootstrap5\ActiveForm;


final class BaseActiveForm extends ActiveForm
{
    
    public $options = ['enctype' => 'multipart/form-data'];
    public $fieldConfig = ['template' => "{label}\n{input}\n{hint}\n{error}"];
    public $encodeErrorSummary = false;
    public $errorSummaryCssClass = 'alert alert-danger';
    public $errorCssClass = 'text-danger';
}