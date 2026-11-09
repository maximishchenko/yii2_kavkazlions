<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\models\PartnerServices;
use frontend\models\search\PartnerServicesSearch;
use frontend\models\search\PartnersSearch;
use frontend\widgets\MaterialsBlock;
use Yii;
use yii\web\NotFoundHttpException;

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

        $materialID = Yii::$app->configManager->getItemValue('partnersServicesTopParallaxTitleID');
        $materialBottomID = Yii::$app->configManager->getItemValue('partnersServicesBottomParallaxTitleID');
        $sponsorsServices = MaterialsBlock::widget(['id' => $materialID]);
        $sponsorsBottomServices = MaterialsBlock::widget(['id' => $materialBottomID]);

        $searchModel = new PartnerServicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('partners-services', [
            'sponsorsServices' => $sponsorsServices,
            'sponsorsBottomServices' => $sponsorsBottomServices,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPartnersServicesView(string $slug): string
    {
        $materialID = Yii::$app->configManager->getItemValue('partnersServicesTopParallaxTitleID');
        $materialBottomID = Yii::$app->configManager->getItemValue('partnersServicesBottomParallaxTitleID');
        $sponsorsServices = MaterialsBlock::widget(['id' => $materialID]);
        $sponsorsBottomServices = MaterialsBlock::widget(['id' => $materialBottomID]);

        $model = $this->findModel($slug);
        return $this->render('partners-services-view', [
            'sponsorsServices' => $sponsorsServices,
            'sponsorsBottomServices' => $sponsorsBottomServices,
            'model' => $model,
        ]);
    }

    protected function findModel(string $slug): PartnerServices
    {
        $service = PartnerServices::findOne(['slug' => $slug]);

        if (($model = $service) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
