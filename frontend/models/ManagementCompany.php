<?php

declare(strict_types=1);

namespace frontend\models;

use common\modules\content\models\ManagementCompany as CommonManagementCompany;
use frontend\models\query\ManagementCompanyQuery;
use common\models\Status;
use Yii;

class ManagementCompany extends CommonManagementCompany
{

    public static function find(): ManagementCompanyQuery|array|null
    {
        return (new ManagementCompanyQuery(get_called_class()))->active();
    }

    /**
     * Связь с руководителями управляющей компании
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManagementLeaders()
    {
        return $this
                ->hasMany(ManagementLeader::class, ['management_company_id' => 'id'])
                ->onCondition(['status' => Status::STATUS_ACTIVE->value])
                ->orderBy(['sort' => SORT_ASC]);
    }

    /**
     * Возвращает количество руководителей управляющей компании
     *
     * @return int
     */
    public function getManagementLeadersCount(): int
    {
        return (int)$this->getManagementLeaders()->count();
    }

    /**
     * Возвращает URL логотипа компании или null, если изображение не задано
     *
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->image ? '/' . self::UPLOAD_PATH . $this->image : null;
    }

    /**
     * Возвращает URL webp-версии логотипа, если файл существует
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

    /**
     * Возвращает URL фонового изображения для parallax-блока или null, если оно не задано
     *
     * @return string|null
     */
    public function getBackgroundImageUrl(): ?string
    {
        return $this->backgroundImage ? '/' . self::UPLOAD_PATH . $this->backgroundImage : null;
    }
}