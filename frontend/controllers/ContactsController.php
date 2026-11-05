<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\widgets\MaterialsBlock;
use frontend\models\Contacts;
// use yii\helpers\ArrayHelper;
use Yii;

final class ContactsController extends BaseController
{
    public function actionIndex(): string
    {
        $contactsParallaxTitleID = Yii::$app->configManager->getItemValue('contactsParallaxTitleID');
        $contactsParallaxSubTitleID =Yii::$app->configManager->getItemValue('contactsParallaxSubTitleID');
        $contactsParallaxTitle = MaterialsBlock::widget(['id' => $contactsParallaxTitleID]);
        $contactsParallaxSubTitle = MaterialsBlock::widget(['id' => $contactsParallaxSubTitleID]);
        $contacts = Contacts::find()->all();
        // $phones = implode(', ', ArrayHelper::getColumn($contacts, 'phone'));
        // $addresses = implode(', ', ArrayHelper::getColumn($contacts, 'address'));

        return $this->render('index', [
            'contactsParallaxTitle' => $contactsParallaxTitle,
            'contactsParallaxSubTitle' => $contactsParallaxSubTitle,
            'contacts' => $contacts,
            // 'phones' => $phones,
            // 'addresses' => $addresses,
        ]);
    }
}
