<?php
declare(strict_types=1);

namespace backend\modules\content\controllers;

use backend\controllers\BaseCrudController;
use backend\modules\content\models\History;
use backend\modules\content\models\search\HistorySearch;
use Yii;
use yii\web\Response;

final class HistoryController extends BaseCrudController
{
    
    const VERBS_ACTIONS = [
            'delete-image' => ['POST'],
        ];

    public function actionIndex(): string
    {
        $searchModel = new HistorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(): string | Response
    {
        $model = new History();

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
     * Удаление единственного изображения
     *
     * @param int $id ID записи в которой удаляется изображение
     * @return Response
     */
    public function actionDeleteImage(int $id): Response
    {
        /** @var History $model */
        $model = $this->findModel($id);
        $file = $model->getPath(History::UPLOAD_PATH, $model->image);
        $model->removeSingleFileIfExist($file);
        $model->image = null;
        $model->save();
        Yii::$app->session->setFlash('danger', Yii::t('app', 'Image file was removed'));
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function getModelClass(): string
    {
        return History::class;
    }
}
