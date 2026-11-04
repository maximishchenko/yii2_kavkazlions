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
    'socialsVk' => [
        'path' => 'socialsVk',
        'label' => Yii::t('app', "Socials VK"),
        'description' => Yii::t('app', "Socials VK DESCRIPTION"),
        'value' => "",
        'rules' => [
            ['url']
        ],
    ],
    'socialsMax' => [
        'path' => 'socialsMax',
        'label' => Yii::t('app', "Socials Max"),
        'description' => Yii::t('app', "Socials Max DESCRIPTION"),
        'value' => "",
        'rules' => [
            ['url']
        ],
    ],
    'companyPositionLtd' => [
        'path' => 'companyPositionLtd',
        'label' => Yii::t('app', "COMPANY_POSITION_LATITUDE"),
        'description' => Yii::t('app', "COMPANY_POSITION_LATITUDE DESCRIPTION"),
        'value' => "44.20764",
        'rules' => [
            ['required']
        ],
        'inputOptions' => [
            'type' => 'float',
        ],
    ],
    'companyPositionLng' => [
        'path' => 'companyPositionLng',
        'label' => Yii::t('app', "COMPANY_POSITION_LONGITUDE"),
        'description' => Yii::t('app', "COMPANY_POSITION_LONGITUDE DESCRIPTION"),
        'value' => "43.12826",
        'rules' => [
            ['required']
        ],
        'inputOptions' => [
            'type' => 'float',
        ],
    ],
    
    'contactsParallaxTitle' => [
        'path' => 'contactsParallaxTitle',
        'label' => Yii::t('app', "CONTACTS_PARALLAX_TITLE"),
        'description' => Yii::t('app', "CONTACTS_PARALLAX_TITLE_DESCRIPTION"),
        'value' => "«Львы Кавказа» всегда на связи",
        'rules' => [
        ],
    ],
    
    'contactsParallaxSubTitle' => [
        'path' => 'contactsParallaxSubTitle',
        'label' => Yii::t('app', "CONTACTS_PARALLAX_SUBTITLE"),
        'description' => Yii::t('app', "CONTACTS_PARALLAX_SUBTITLE_DESCRIPTION"),
        'value' => "Приходите на тренировку, звоните или пишите — ответим на все вопросы",
        'rules' => [
        ],
        'inputOptions' => [
            'type' => 'textarea',
        ],
    ],

    'sponsorsProposal' => [
        'path' => 'sponsorsProposal',
        'label' => Yii::t('app', "Sponsors Proposal"),
        'description' => Yii::t('app', "Sponsors Proposal DESCRIPTION"),
        'value' => "<p>Станьте спонсором школы «Львы Кавказа» — поддержите развитие спорта и воспитание подрастающего поколения.</p>",
        'rules' => [
        ],
        'inputOptions' => [
            'type' => 'imperavi',
        ],
    ],
];