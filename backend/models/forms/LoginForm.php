<?php

declare(strict_types=1);

namespace backend\models\forms;

use common\models\forms\LoginForm as CommonLoginForm;
use Yii;
use Override;

final class LoginForm extends CommonLoginForm
{
    #[Override]
    public function attributeLabels(): array
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'rememberMe' => Yii::t('app', 'Remember Me'),
        ];
    }
}