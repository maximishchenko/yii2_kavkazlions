<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\models\search\HistorySearch;
    
final class HistoryController extends BaseController
{

    public function actionIndex(): string
    {
        $searchModel = new HistorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
}
