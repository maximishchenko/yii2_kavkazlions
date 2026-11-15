<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\models\DocumentsCategory;
use frontend\models\Documents;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

final class DocumentsController extends BaseController
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DocumentsCategory::find()->andWhere(['parent_id' => 0])->orderBy(['sort' => SORT_ASC, 'id' => SORT_ASC]),
            'pagination' => false,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCategory(string $slug): string
    {
        $category = DocumentsCategory::find()->andWhere(['slug' => $slug])->one();
        if ($category === null) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $categories = new ActiveDataProvider([
            'query' => DocumentsCategory::find()->andWhere(['parent_id' => $category->id])->orderBy(['sort' => SORT_ASC, 'id' => SORT_ASC]),
            'pagination' => false,
        ]);
        $documents = new ActiveDataProvider([
            'query' => Documents::find()->andWhere(['category_id' => $category->id])->orderBy(['sort' => SORT_ASC, 'id' => SORT_ASC]),
            'pagination' => false,
        ]);
        $rootCategories = DocumentsCategory::find()
            ->andWhere(['parent_id' => 0])
            ->orderBy(['sort' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        return $this->render('category', compact('category', 'categories', 'documents', 'rootCategories'));
    }

    public function actionView(string $slug): string
    {
        $document = Documents::find()->andWhere(['slug' => $slug])->with('attachments')->one();
        if ($document === null) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $category = DocumentsCategory::find()->andWhere(['id' => $document->category_id])->one();
        $rootCategories = DocumentsCategory::find()
            ->andWhere(['parent_id' => 0])
            ->orderBy(['sort' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        return $this->render('view', compact('document', 'category', 'rootCategories'));
    }
}
