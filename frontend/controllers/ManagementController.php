<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;


final class ManagementController extends BaseController
{
    public function actionIndex(): string
    {
        return $this->render('index', [
            
        ]);
    }
}