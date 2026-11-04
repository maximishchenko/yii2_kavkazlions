<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;


class SponsorsController extends BaseController
{
    public function actionIndex(): string
    {
        return $this->render('index', []);
    }

    public function actionProposal(): string
    {
        return $this->render('proposal', []);
    }
}