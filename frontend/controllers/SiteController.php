<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use yii\web\ErrorAction;

final class SiteController extends BaseController
{
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
