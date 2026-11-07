<?php

declare(strict_types=1);

namespace frontend\models;

use common\modules\content\models\History as CommonHistory;
use frontend\models\query\HistoryQuery;
use Yii;

class History extends CommonHistory
{
    public static function find(): HistoryQuery | array | null
    {
        return (new HistoryQuery(get_called_class()))->active();
    }

    public function getImageUrl(): ?string
    {
        return $this->image ? '/' . self::UPLOAD_PATH . $this->image : null;
    }

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
