<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\controllers\BaseController;
use frontend\widgets\MaterialsBlock;
use frontend\models\Contacts;
use Yii;

final class ContactsController extends BaseController
{
    public function actionIndex(): string
    {
        $contactsParallaxTitleID = Yii::$app->configManager->getItemValue('contactsParallaxTitleID');
        $contactsParallaxSubTitleID =Yii::$app->configManager->getItemValue('contactsParallaxSubTitleID');
        $contactsBottomParallaxTitleID = Yii::$app->configManager->getItemValue('contactsBottomParallaxTitleID');
        $contactsBottomParallaxSubTitleID =Yii::$app->configManager->getItemValue('contactsBottomParallaxSubTitleID');
        $contactsParallaxTitle = MaterialsBlock::widget(['id' => $contactsParallaxTitleID]);
        $contactsParallaxSubTitle = MaterialsBlock::widget(['id' => $contactsParallaxSubTitleID]);
        $contactsBottomParallaxTitle = MaterialsBlock::widget(['id' => $contactsBottomParallaxTitleID]);
        $contactsBottomParallaxSubTitle = MaterialsBlock::widget(['id' => $contactsBottomParallaxSubTitleID]);
        $contacts = Contacts::find()->all();

        return $this->render('index', [
            'contactsParallaxTitle' => $contactsParallaxTitle,
            'contactsParallaxSubTitle' => $contactsParallaxSubTitle,
            'contacts' => $contacts,
            'contactsBottomParallaxTitle' => $contactsBottomParallaxTitle,
            'contactsBottomParallaxSubTitle' => $contactsBottomParallaxSubTitle,
        ]);
    }
}
