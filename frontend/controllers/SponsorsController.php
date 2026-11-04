<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use Yii;

final class SponsorsController extends BaseController
{

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionProposal(): string
    {
        $sponsorsProposal = Yii::$app->configManager->getItemValue('sponsorsProposal');
        return $this->render('proposal', [
            'sponsorsProposal' => $sponsorsProposal
        ]);
    }
}
