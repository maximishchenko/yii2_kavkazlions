<?php

declare(strict_types=1);

namespace backend\modules\content\controllers;

use backend\modules\content\models\PartnerServices;
use backend\modules\content\models\search\PartnerServicesSearch;
use backend\controllers\BaseCrudController;
use backend\modules\content\models\PartnerServicesImages;
use frontend\models\Partners;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

final class PartnerServicesController extends BaseCrudController
{
    const VERBS_ACTIONS = [
            'delete-image' => ['POST'],
        ];

    public function actionIndex(): string
    {
        $searchModel = new PartnerServicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(): string | Response
    {
        $model = new PartnerServices();

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
    
    /**
     * Drag'n'Drop сортировка изображений
     */
    public function actionSaveImageSort(): void
    {
        $order = Yii::$app->request->post('order');
        foreach($order as $sort => $imageId) {
            if(isset($imageId) && !empty($imageId)) {
                $image = PartnerServicesImages::findOne($imageId);
                $image->sort = $sort;
                $image->save();
            }
        }
    }
    
    public function actionDeleteImage(int $id): string|Response
    {
        $model = $this->findImageModel($id);
        $model->delete();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Record deleted'));
        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findImageModel(int $id): PartnerServicesImages
    {
        if (($model = PartnerServicesImages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function getModelclass(): string
    {
        return PartnerServices::class;
    }
}
