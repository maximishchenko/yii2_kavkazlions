<?php

return [
    
    'companyName' => [
        'path' => 'companyName',
        'label' => Yii::t('app', "COMPANY_NAME"),
        'description' => Yii::t('app', "COMPANY_NAME_DESCRIPTION"),
        'value' => "РОО ДЮСШЕ \"Львы Кавказа\"",
        'rules' => [
            ['required']
        ],
    ],
    'companyNameFull' => [
        'path' => 'companyNameFull',
        'label' => Yii::t('app', "COMPANY_NAME_FULL"),
        'description' => Yii::t('app', "COMPANY_NAME_FULL_DESCRIPTION"),
        'value' => "РОО «Детско-юношеская спортивная школа единоборств «Львы Кавказа» Ставропольского края",
        'rules' => [
            ['required'],
        ],
        'inputOptions' => [
            'type' => 'textarea',
        ],
    ],
    'companySlogan' => [
        'path' => 'companySlogan',
        'label' => Yii::t('app', "COMPANY_SLOGAN"),
        'description' => Yii::t('app', "COMPANY_SLOGAN_DESCRIPTION"),
        'value' => "Самооборона – школа выживания!",
        'rules' => [
        ],
        'inputOptions' => [
            'type' => 'textarea',
        ],
    ],
    'companyStartDate' => [
        'path' => 'startDate',
        'label' => Yii::t('app', "COMPANY_START_DATE"),
        'description' => Yii::t('app', "COMPANY_START_DATE DESCRIPTION"),
        'value' => "2003",
        'rules' => [
            ['required']
        ],
        'inputOptions' => [
            'type' => 'integer',
        ],
    ],
    'contactPhone' => [
        'path' => 'phone',
        'label' => Yii::t('app', "CONTACT_PHONE"),
        'description' => Yii::t('app', "CONTACT_PHONE DESCRIPTION"),
        'value' => "+7 (906) 411-14-07",
        'rules' => [
            ['required']
        ],
        'inputOptions' => [
            'type' => 'phone',
        ],
    ],
    'contactEmail' => [
        'path' => 'email',
        'label' => Yii::t('app', "CONTACT_EMAIL"),
        'description' => Yii::t('app', "CONTACT_EMAIL DESCRIPTION"),
        'value' => "info@kavkazlions.ru",
        'rules' => [
            ['required'],
            ['email']
        ],
    ],
    'contactAddress' => [
        'path' => 'contactAddress',
        'label' => Yii::t('app', "Contact Address"),
        'description' => Yii::t('app', "Contact Address DESCRIPTION"),
        'value' => "г. Минеральные Воды, ул. Пятигорская, 25",
        'rules' => [
        ],
    ],
    'mapApiKey' => [
        'path' => 'mapApiKey',
        'label' => Yii::t('app', "MAP API KEY"),
        'description' => Yii::t('app', "MAP API KEY DESCRIPTION"),
        'value' => "95783d3e-baf2-4026-8217-9ceb97f17d39",
        'rules' => [
        ],
    ],
    'isWebSiteOffline' => [
        'path' => 'is_website_offline',
        'label' => Yii::t('app', "IS_WEBSITE_OFFLINE"),
        'description' => Yii::t('app', "IS_WEBSITE_OFFLINE DESCRIPTION"),
        'value' => false,
        'rules' => [
        ],
        'inputOptions' => [
            'type' => 'checkbox',
        ],
    ],
];