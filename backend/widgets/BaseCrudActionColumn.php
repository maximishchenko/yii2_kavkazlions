<?php

declare(strict_types=1);

namespace backend\widgets;

use yii\grid\ActionColumn;


final class BaseCrudActionColumn extends ActionColumn
{
    public $template = '{update} &nbsp; {delete}';

    public $contentOptions = ['style' => 'width:100px;'];
}