<?php

declare(strict_types=1);

return [
    'params' => [
        'adminEmail' => 'admin@example.com',
        'user.passwordResetTokenExpire' => 3600,
    ],
    'components' => [
        'db' => ['class' => yii\db\Connection::class],
    ],
];