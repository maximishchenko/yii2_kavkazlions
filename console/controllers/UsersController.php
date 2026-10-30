<?php

declare(strict_types=1);

namespace console\controllers;
 
use console\models\User;
use console\controllers\BaseController;
use yii\console\Exception;
use yii\helpers\Console;
 
final class UsersController extends BaseController
{
    public function actionIndex(): void
    {
        echo 'yii users/create' . PHP_EOL;
        echo 'yii users/remove' . PHP_EOL;
        echo 'yii users/activate' . PHP_EOL;
        echo 'yii users/change-password' . PHP_EOL;
    }
 
    public function actionCreate(): void
    {
        $model = new User();
        $this->readValue($model, 'username');
        $this->readValue($model, 'email');
        $model->setPassword($this->prompt('Password:', [
            'required' => true,
            'pattern' => '#^.{6,255}$#i',
            'error' => 'More than 6 symbols',
        ]));
        $model->generateAuthKey();
        $model->status = User::STATUS_ACTIVE;
        $this->log($model->save());
    }
 
    public function actionRemove(): void
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $model = $this->findModel($username);
        $this->log($model->delete());
    }
 
    public function actionActivate(): void
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $model = $this->findModel($username);
        $model->status = User::STATUS_ACTIVE;
        $this->log($model->save());
    }
 
    public function actionChangePassword(): void
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $model = $this->findModel($username);
        $model->setPassword($this->prompt('New password:', [
            'required' => true,
            'pattern' => '#^.{6,255}$#i',
            'error' => 'More than 6 symbols',
        ]));
        $this->log($model->save());
    }
 
    private function findModel(string $username): User
    {
        if (!$model = User::findOne(['username' => $username])) {
            throw new Exception('User not found');
        }
        return $model;
    }
 
    private function readValue(User $model, string $attribute): void
    {
        $model->$attribute = $this->prompt(mb_convert_case($attribute, MB_CASE_TITLE, 'utf-8') . ':', [
            'validator' => function ($input, &$error) use ($model, $attribute) {
                $model->$attribute = $input;
                if ($model->validate([$attribute])) {
                    return true;
                } else {
                    $error = implode(',', $model->getErrors()[$attribute] ?? []);
                    return false;
                }
            },
        ]);
    }
 
    private function log(int | bool $success): void
    {
        if ($success) {
            $this->stdout('Success!', Console::FG_GREEN, Console::BOLD);
        } else {
            $this->stderr('Error!', Console::FG_RED, Console::BOLD);
        }
        echo PHP_EOL;
    }
}