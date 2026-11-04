<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\Status;
use common\modules\content\models\ManagementLeader as CommonManagementLeader;
use frontend\models\query\ManagementCompanyQuery;
use frontend\models\query\ManagementLeaderQuery;
use Yii;

class ManagementLeader extends CommonManagementLeader
{

    /**
     * Gets query for [[ManagementCompany]].
     *
     * @return \yii\db\ActiveQuery|ManagementCompanyQuery
     */
    public function getManagementCompany()
    {
        return $this->hasOne(ManagementCompany::class, ['id' => 'management_company_id'])
                ->onCondition(['status' => Status::STATUS_ACTIVE->value])
                ->orderBy(['sort' => SORT_ASC]);
    }

    public static function find(): ManagementLeaderQuery
    {
        return new ManagementLeaderQuery(get_called_class());
    }

    /**
     * Возвращает URL фотографии руководителя или null, если изображение не задано
     *
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->image ? '/' . self::UPLOAD_PATH . $this->image : null;
    }

    /**
     * Возвращает URL webp-версии фотографии, если файл существует
     *
     * @return string|null
     */
    public function getImageWebpUrl(): ?string
    {
        if (!$this->image) {
            return null;
        }

        $webpFile = preg_replace('/\.(png|jpe?g)$/i', '.webp', $this->image);

        if ($webpFile === $this->image) {
            return null;
        }

        return file_exists(Yii::getAlias('@frontend/web/') . self::UPLOAD_PATH . $webpFile)
            ? '/' . self::UPLOAD_PATH . $webpFile
            : null;
    }
}