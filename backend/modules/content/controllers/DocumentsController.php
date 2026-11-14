<?php

declare(strict_types=1);

namespace backend\modules\content\controllers;

use backend\modules\content\models\Documents;
use backend\modules\content\models\search\DocumentsSearch;
use backend\controllers\BaseCrudController;
use Yii;
use vova07\imperavi\actions\UploadFileAction;
use yii\web\Response;

final class DocumentsController extends BaseCrudController
{
    public function actions(): array
    {
        return [
            'image-upload' => [
                'class' => UploadFileAction::class,
                'url' => '/uploads/documents/images/',
                'path' => '@frontend/web/uploads/documents/images',
            ],
            'file-upload' => [
                'class' => UploadFileAction::class,
                'url' => '/uploads/documents/files/',
                'path' => '@frontend/web/uploads/documents/files',
                'uploadOnlyImage' => false,
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new DocumentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(): string | Response
    {
        $model = new Documents();

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
        return Documents::class;
    }
}
