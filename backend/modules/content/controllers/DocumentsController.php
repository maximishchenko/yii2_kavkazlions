<?php

declare(strict_types=1);

namespace backend\modules\content\controllers;

use backend\modules\content\models\Documents;
use backend\modules\content\models\DocumentsAttach;
use backend\modules\content\models\search\DocumentsSearch;
use backend\controllers\BaseCrudController;
use common\models\Sort;
use Yii;
use vova07\imperavi\actions\UploadFileAction;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
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

    public function actionAttaches(int $id): string
    {
        $model = $this->findModel($id);
        $query = DocumentsAttach::find()->where(['document_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => Sort::getBackendDefaultSort()],
            'pagination' => [
                'pageSize' => false,
            ]
        ]);
        return $this->render('attach/index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionCreateAttach(int $id): string | Response
    {
        $model = $this->findModel($id);
        $attachModel = new DocumentsAttach();
        $attachModel->document_id = $model->id;

        if ($this->request->isPost) {
            if ($attachModel->load($this->request->post()) && $attachModel->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Record added'));
                return $this->redirect(['update-attach', 'id' => $model->id, 'attachId' => $attachModel->id]);
            }
        } else {
            $attachModel->loadDefaultValues();
        }

        return $this->render('attach/create', [
            'model' => $model,
            'attachModel' => $attachModel,
        ]);   
    }

    public function actionUpdateAttach(int $id, int $attachId): string | Response
    {
        $model = $this->findModel($id);
        $attachModel = $this->findAttachModel($attachId);

        if ($this->request->isPost && $attachModel->load($this->request->post()) && $attachModel->save()) {
            Yii::$app->session->setFlash('info', Yii::t('app', 'Record changed'));
            return $this->refresh();
        }

        return $this->render('attach/update', [
            'model' => $model,
            'attachModel' => $attachModel,
        ]);
    }

    public function actionDeleteAttach(int $id, int $attachId): Response
    {
        
        $this->findAttachModel($attachId)->delete();
        Yii::$app->session->setFlash('warning', Yii::t('app', 'Attach deleted'));

        return $this->redirect(['attaches', 'id' => $id]);
    }
    

    /**
     * Поиск модели вложений по ID
     *
     * @param int|string $attachId
     * @throws NotFoundHttpException
     */
    protected function findAttachModel(int $attachId): DocumentsAttach
    {
        if (($model = DocumentsAttach::findOne($attachId)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function getModelClass(): string
    {
        return Documents::class;
    }
}
