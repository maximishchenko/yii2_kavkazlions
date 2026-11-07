<?php

declare(strict_types=1);

namespace backend\modules\content\controllers;

use backend\modules\content\models\search\MaterialsSearch;
use backend\modules\content\models\Materials;
use backend\controllers\BaseCrudController;
use yii\web\Response;
use vova07\imperavi\actions\UploadFileAction;
use Yii;

final class MaterialsController extends BaseCrudController
{

    public function actions(): array
    {
        return [
            'image-upload' => [
                'class' => UploadFileAction::class,
                'url' => '/uploads/materials/images/',
                'path' => '@frontend/web/uploads/materials/images',
            ],
            'file-upload' => [
                'class' => UploadFileAction::class,
                'url' => '/uploads/materials/files/',
                'path' => '@frontend/web/uploads/materials/files',
                'uploadOnlyImage' => false,
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new MaterialsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(): string | Response
    {
        $model = new Materials();

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

    protected function getModelClass(): string
    {
        return Materials::class;
    }
}
