<?php

declare(strict_types=1);

namespace common\models\forms;

use Yii;
use common\models\BaseModel;
use common\modules\management\models\User;


abstract class LoginForm extends BaseModel
{
    /**
     * Имя пользователя
     *
     * @var string $username
     */
    public $username;

    /**
     * Пароль пользователя
     *
     * @var string $password
     */
    public $password;

    /**
     * Запомнить авторизацию пользователя
     *
     * @var boolean $rememberMe
     */
    public bool $rememberMe = true;

    /**
     * Пользователь
     *
     * @var User | null $_user
     */
    private $_user;

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword(string $attribute, array|null $params): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    protected function getUser(): User|null
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
