<?php

declare(strict_types=1);

namespace backend\modules\management\controllers;

use backend\controllers\BaseController;

final class DefaultController extends BaseController
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
