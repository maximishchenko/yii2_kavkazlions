<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\models\search\HistorySearch;
use frontend\widgets\MaterialsBlock;
use Yii;

final class HistoryController extends BaseController
{

    public function actionIndex(): string
    {
        $historyTopParallaxTextID = Yii::$app->configManager->getItemValue('historyTopParallaxTitleID');
        $historyBottomParallaxTextID = Yii::$app->configManager->getItemValue('historyBottomParallaxTitleID');
        $historyTopParallaxText = MaterialsBlock::widget(['id' => $historyTopParallaxTextID]);
        $historyBottomParallaxText = MaterialsBlock::widget(['id' => $historyBottomParallaxTextID]);
        
        $searchModel = new HistorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'historyTopParallaxText' => $historyTopParallaxText,
            'historyBottomParallaxText' => $historyBottomParallaxText,
        ]);
    }
}
