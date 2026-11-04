<?php

declare(strict_types=1);

namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Отображает изображение предварительного просмотра
 * загруженного файла, добавляет кнопку удаления
 */
final class SingleImagePreviewWidget extends Widget
{
    /**
     *
     * @var int id записи в БД, содержащей изображение, подставляется в ссылку удаления файла
     */
    public ?int $id = null;

    /**
     *
     * @var string Полный путь к файлу, подставляется в тэг <img>
     */
    public $filePath;

    /**
     *
     * @var string метод удаления файла
     */
    public $url = null;

    public $fancyboxGalleryName = "gallery";

    /**
     * @var array Дополнительные атрибуты тега <a> (например, data-src и data-type для inline-контента Fancybox).
     * Если задан 'data-src', атрибут href не выводится.
     */
    public $linkOptions = [];

    /**
     * @var string|null Готовый HTML предварительного просмотра, выводится вместо тега <img>
     */
    public $previewContent = null;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
    ?>

        <div class='col-md-3' id="<?= $this->id; ?>" style="display: inline-block;">
            <li class="sortable__items">
                <?php
                $linkOptions = array_merge(['data-caption' => '', 'data-fancybox' => $this->fancyboxGalleryName], $this->linkOptions);
                if (!isset($linkOptions['data-src'])) {
                    $linkOptions['href'] = $this->filePath;
                }
                ?>
                <?= Html::beginTag('a', $linkOptions); ?>
                    <?php if ($this->previewContent !== null): ?>
                        <?= $this->previewContent; ?>
                    <?php else: ?>
                        <img width='100%' src="<?= $this->filePath; ?>" >
                    <?php endif; ?>
                </a>
            </li>
            <?php if (isset($this->url) && !empty($this->url) && isset($this->id) && !empty($this->id)): ?>
                <?php // echo Html::a('<i class="fa fa-trash"></i>', [$this->url, 'id' => $this->id], ['class' => 'btn btn-danger img__delete__btn', 'data-confirm' => Yii::t('app', 'DO DELETE ANSWER'), 'data-method' => 'post']); ?>
                <?= Html::a('<i class="fa fa-trash"></i>', [$this->url, 'id' => $this->id], ['class' => 'btn btn-danger img__delete__btn', 'data-confirm' => Yii::t('app', 'Do delete image answer'), 'data-method' => 'post']); ?>
            <?php endif; ?>
        </div>
    <?php
    }
}