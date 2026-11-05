<?php

declare(strict_types=1);

namespace backend\modules\management\models;

use Yii;

class Setting extends \yii\base\Model
{

    const TAB_CONTACT = 'contact';
    const TAB_SERVICES = 'services';
    const TAB_GLOBAL = 'global';
    const TAB_MATERIALS = 'materials';

    public static function getTabsArray(): array
    {
        return [
            self::TAB_CONTACT => Yii::t('app', 'SETTING_CONTACT_TAB'),
            self::TAB_SERVICES => Yii::t('app', 'SETTING_SERVICES_TAB'),
            self::TAB_GLOBAL => Yii::t('app', 'SETTING_TAB_GLOBAL'),
            self::TAB_MATERIALS => Yii::t('app', 'TAB_MATERIALS'),
        ];
    }

    public static function getGlobalTabsArray(): array
    {
        return [
            self::TAB_CONTACT,
            self::TAB_SERVICES,
            self::TAB_GLOBAL,
            self::TAB_MATERIALS,
        ];
    }

    public static function getTabsItems(): array
    {
        return [
            self::TAB_CONTACT => [
                'phone',
                'email',
                'contactAddress',
                'socialsVk',
                'socialsMax',
            ],
            self::TAB_SERVICES => [
                'mapApiKey',
                'companyPositionLtd',
                'companyPositionLng',
            ],
            self::TAB_GLOBAL => [
                'companyName',
                'is_website_offline',
                'startDate',
            ],
            self::TAB_MATERIALS => [
                'sponsorsProposalId',
                'contactsParallaxTitleID',
                'contactsParallaxSubTitleID',
                'contactsBottomParallaxTitleID',
                'contactsBottomParallaxSubTitleID',
                'templateFooterSloganID',
                'templateCompanyFullNameID',
            ],
        ];
    }
}
