<?php

declare(strict_types=1);

namespace backend\modules\content\controllers;

use backend\modules\content\models\Partners;
use backend\modules\content\models\search\PartnersSearch;
use backend\controllers\BaseCrudController;
use Yii;
use yii\web\Response;

final class PartnersController extends BaseCrudController
{
    public function actionIndex(): string
    {
        $searchModel = new PartnersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(): string | Response
    {
        $model = new Partners();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Record added'));
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('primary/create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id): string | Response
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('info', Yii::t('app', 'Record changed'));
            return $this->refresh();
        }

        return $this->render('primary/update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('warning', Yii::t('app', 'Record deleted'));

        return $this->redirect(['index']);
    }

    protected function getModelclass(): string
    {
        return Partners::class;
    }
}
