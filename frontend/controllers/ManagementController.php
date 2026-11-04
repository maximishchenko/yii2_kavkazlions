<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\models\ManagementCompany;
use frontend\models\ManagementLeader;
use frontend\models\search\ManagementCompanySearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

final class ManagementController extends BaseController
{
    public function actionIndex(): string
    {
        $searchModel = new ManagementCompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(string $slug): string | Response
    {
        $model = $this->findModel($slug);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Страница руководителя организации
     *
     * @param string $companySlug slug организации
     * @param string $slug slug руководителя
     */
    public function actionLeader(string $companySlug, string $slug): string | Response
    {
        $company = $this->findModel($companySlug);
        $model = $this->findLeaderModel($company, $slug);

        return $this->render('leader', [
            'company' => $company,
            'model' => $model,
        ]);
    }

    /**
     * Производит поиск активного руководителя по slug организации и slug руководителя
     *
     * @param ManagementCompany $company
     * @param string $slug
     */
    protected function findLeaderModel(ManagementCompany $company, string $slug): ManagementLeader
    {
        $model = ManagementLeader::find()
            ->active()
            ->andWhere(['slug' => $slug, 'management_company_id' => $company->id])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
 
    /**
     * Производит поиск модели по значению $slug
     *
     * @param string $slug
     */
    protected function findModel(string $slug): ManagementCompany
    {
        $collection = ManagementCompany::findOne(['slug' => $slug]);

        if (($model = $collection) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}