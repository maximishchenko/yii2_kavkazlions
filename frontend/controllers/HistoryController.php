<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\widgets\MaterialsBlock;

final class HistoryController extends BaseController
{

    public function actionIndex(): string
    {
        $contactsID = 15;
        $history = MaterialsBlock::widget(['id' => $contactsID]);

        return $this->render('index', [
            'history' => $history,
        ]);
    }
}
