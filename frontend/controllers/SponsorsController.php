<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\widgets\MaterialsBlock;
use Yii;

final class SponsorsController extends BaseController
{

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionProposal(): string
    {
        $materialID = Yii::$app->configManager->getItemValue('sponsorsProposalId');
        $sponsorsProposal = MaterialsBlock::widget(['id' => $materialID]);
        return $this->render('proposal', [
            'sponsorsProposal' => $sponsorsProposal
        ]);
    }
}
