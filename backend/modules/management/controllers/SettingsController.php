<?php

declare(strict_types=1);

namespace backend\modules\management\controllers;

use backend\controllers\BaseController;
use backend\modules\management\models\Setting;
use yii\base\Model;
use Yii;
use yii\web\Response;

final class SettingsController extends BaseController
{
    public function actionIndex(): string | Response
    {
        /* @var $configManager \yii2tech\config\Manager */
        $configManager = Yii::$app->get('configManager');

        $models = $configManager->getItems();

        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            $configManager->saveValues();
            Yii::$app->session->setFlash('success', Yii::t('app', 'Configuration updated.'));
            return $this->refresh();
        }

        return $this->render('index', [
            'models' => $models,
            'tabs' => Setting::getGlobalTabsArray(),
            'name' => Yii::t('app', 'GLOBAL SETTINGS')
        ]);
    }

    /**
     * Restores default values for the application configuration.
     */
    public function actionDefault(): Response
    {
        /* @var $configManager \yii2tech\config\Manager */
        $configManager = Yii::$app->get('configManager');
        $configManager->clearValues();
        Yii::$app->session->setFlash('warning', Yii::t('app', 'Default values restored.'));
        return $this->redirect(['index']);
    }
}