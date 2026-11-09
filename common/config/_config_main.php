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
        'value' => "https://vk.com/club75097076",
        'rules' => [
            ['url']
        ],
    ],
    'socialsMax' => [
        'path' => 'socialsMax',
        'label' => Yii::t('app', "Socials Max"),
        'description' => Yii::t('app', "Socials Max DESCRIPTION"),
        'value' => "http://www.ok.ru/dskelvykav",
        'rules' => [
            ['url']
        ],
    ],
    'socialsOk' => [
        'path' => 'socialsOk',
        'label' => Yii::t('app', "Socials OK"),
        'description' => Yii::t('app', "Socials OK DESCRIPTION"),
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
    
    'sponsorsProposalId' => [
        'path' => 'sponsorsProposalId',
        'label' => Yii::t('app', "SPONSORS_PROPOSAL_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'contactsParallaxTitleID' => [
        'path' => 'contactsParallaxTitleID',
        'label' => Yii::t('app', "CONTACTS_PARALLAX_TITLE_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'contactsParallaxSubTitleID' => [
        'path' => 'contactsParallaxSubTitleID',
        'label' => Yii::t('app', "CONTACTS_PARALLAX_SUBTITLE_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'templateFooterSloganID' => [
        'path' => 'templateFooterSloganID',
        'label' => Yii::t('app', "TEMPLATE_FOOTER_SLOGAN_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'templateCompanyFullNameID' => [
        'path' => 'templateCompanyFullNameID',
        'label' => Yii::t('app', "TEMPLATE_COMPANY_FULL_NAME_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'contactsBottomParallaxTitleID' => [
        'path' => 'contactsBottomParallaxTitleID',
        'label' => Yii::t('app', "CONTACTS_PARALLAX_BOTOM_TITLE_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'contactsBottomParallaxSubTitleID' => [
        'path' => 'contactsBottomParallaxSubTitleID',
        'label' => Yii::t('app', "CONTACTS_PARALLAX_BOTTOM_SUBTITLE_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'sponsorsProposalBottomId' => [
        'path' => 'sponsorsProposalBottomId',
        'label' => Yii::t('app', "SPONSORS_PROPOSAL_BOTTOM_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'historyTopParallaxTitleID' => [
        'path' => 'historyTopParallaxTitleID',
        'label' => Yii::t('app', "HISTORY_PARALLAX_TOP_TITLE_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'historyBottomParallaxTitleID' => [
        'path' => 'historyBottomParallaxTitleID',
        'label' => Yii::t('app', "HISTORY_PARALLAX_BOTOM_TITLE_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'partnersServicesTopParallaxTitleID' => [
        'path' => 'partnersServicesTopParallaxTitleID',
        'label' => Yii::t('app', "PARTNERS_SERVICES_PARALLAX_TOP_TITLE_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
    'partnersServicesBottomParallaxTitleID' => [
        'path' => 'partnersServicesBottomParallaxTitleID',
        'label' => Yii::t('app', "PARTNERS_SERVICES_PARALLAX_BOTOM_TITLE_ID"),
        'description' => Yii::t('app', "MATERIAL_ID DESCRIPTION"),
        'value' => "",
        'inputOptions' => [
            'type' => 'number',
        ],
    ],
];