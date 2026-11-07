<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\models\search\PartnerServicesSearch;
use frontend\models\search\PartnersSearch;
use frontend\widgets\MaterialsBlock;
use Yii;

final class SponsorsController extends BaseController
{

    public function actionIndex(): string
    {
        $searchModel = new PartnersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProposal(): string
    {
        $materialID = Yii::$app->configManager->getItemValue('sponsorsProposalId');
        $materialBottomID = Yii::$app->configManager->getItemValue('sponsorsProposalBottomId');
        $sponsorsProposal = MaterialsBlock::widget(['id' => $materialID]);
        $sponsorsBottomProposal = MaterialsBlock::widget(['id' => $materialBottomID]);
        
        $searchModel = new PartnersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        return $this->render('proposal', [
            'sponsorsProposal' => $sponsorsProposal,
            'sponsorsBottomProposal' => $sponsorsBottomProposal,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPartnersServices(): string
    {
        $searchModel = new PartnerServicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('partners-services', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
