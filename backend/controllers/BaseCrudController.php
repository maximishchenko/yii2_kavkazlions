<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\controllers\BaseController;
use Exception;
use yii\web\NotFoundHttpException;
use yii\db\ActiveRecord;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use Yii;

abstract class BaseCrudController extends BaseController
{    

    const VERBS_BEHAVIORS_KEY = 'verbs';
    
    const VERBS_ACTIONS_BEHAVIORS_KEY = 'verbs.actions';

    const BASE_BEHAVIORS = [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];

    /**
     * Обязательный метод для дочерних классов.
     * Должен возвращать полное имя класса модели (например, User::class).
     * 
     * @return class-string<ActiveRecord>
     */
    abstract protected function getModelClass(): string;

    public function behaviors(): array
    {
        $behaviors = $this->setVerbs();
        return $behaviors;
    }

    protected function setVerbs(): array
    {
        $behaviors = self::BASE_BEHAVIORS;
        if (defined('static::VERBS_ACTIONS')) {
            if (!is_array(static::VERBS_ACTIONS)) {
                throw new Exception(
                        Yii::t('app', 'VERBS_ACTIONS constant must be an array')
                    );
            }
            $existingActions = ArrayHelper::getValue(
                $behaviors,
                static::VERBS_ACTIONS_BEHAVIORS_KEY,
                []
            );
            ArrayHelper::setValue(
                $behaviors, 
                'verbs', 
                [
                    'class' => VerbFilter::class,
                    'actions' => ArrayHelper::merge($existingActions, static::VERBS_ACTIONS),
                ]
            );
            return $behaviors;
        }
        return $behaviors;
    }

    /**
     * Универсальный поиск модели по ID для PHP 8+
     *
     * @param int|string $id
     * @param class-string<ActiveRecord> $modelClass Строгая проверка имени класса для PHPStan/Psalm
     * @throws NotFoundHttpException
     * @throws \InvalidArgumentException
     */
    protected function findModel(int $id): ActiveRecord
    {
        $modelClass = $this->getModelClass();
        if (!class_exists($modelClass) || !is_subclass_of($modelClass, ActiveRecord::class)) {
            throw new \InvalidArgumentException(
                    Yii::t('app', "Class must be child of ActiveRecord Instance")
                );
        }
        $model = $modelClass::findOne($id);
        return $model ?? throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}