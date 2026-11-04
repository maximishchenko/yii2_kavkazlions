<?php

declare(strict_types=1);

namespace backend\traits;

use yii\web\UploadedFile;


/**
 * Обеспечивает операции загрузки, обновления записи и удаления файлов
 */
trait FileTrait
{
    private static string $frontendPath = '../../frontend/web/';
    
    private static string $frontendAlias =  '@frontend/web';

    /**
     * Загружает один файл, записывает имя файла в значение аттрибута в БД
     *
     * @param string $fileAttribute название виртуального аттрибута загруженного файла, полученного от \yii\web\UploadedFile
     * @param string $fileField название аттрибута, соответствующего полю в БД для хранения имени файла
     * @param string $uploadPath строка пути к каталогу загружаемого файла
     * 
     * @return void
     */
    public function uploadFile(string $fileAttribute, string $fileField, string $uploadPath, bool $multiple = false): void
    {
        /** @var \yii\db\ActiveRecord $this */
        if (!$multiple) {
           $this->$fileAttribute = UploadedFile::getInstance($this, $fileAttribute);
        } 

        if ($this->$fileAttribute) {
            $file = $this->setPath($this->$fileAttribute, $uploadPath);
            if(!$this->isNewRecord && $this->$fileField) {
                $filePath = $this->getPath($uploadPath, $this->$fileField);
                $this->removeSingleFileIfExist($filePath);
            }
            $this->$fileAttribute->saveAs($file);

            $this->convertToWebp($file);

            $this->$fileField = basename($file);
        }
    }

    public function deleteMultipleFiles(string $filesAttribute, string $fileField, string $uploadPath): void
    {
        if ($this->$filesAttribute) {
            foreach ($this->$filesAttribute as $file) {
                $filePath = $this->getPath($uploadPath, $file->$fileField);
                $this->removeSingleFileIfExist($filePath);
            }
        }
    }

    public function deleteSingleFile(string $fileField, string $uploadPath): void
    {
        if($this->$fileField) {
            $filePath = $this->getPath($uploadPath, $this->$fileField);
            $this->removeSingleFileIfExist($filePath);
        }
    }


    /**
     * Возвращает полный путь к загруженному файлу или null если файл отсутствует
     *
     * @return string|null
     */
    public function getPath(string $path, string $file): ?string
    {
        return (isset($file)) ? self::$frontendPath . $path . $file : null;
    }

    /**
     * Возвращает относительный путь к файлу изображения
     *
     * @return string
     */
    public function getUrl(string $path, string $file): string
    {
        return "/" . $path . $file;
    }

    /**
     * Проверяет наличие загруженного файла
     *
     * @return bool
     */
    public function isFile(mixed $attribute): bool
    {
        return isset($attribute) && !empty($attribute) ? true : false;
    }

    /**
     * Удаляет файл из файловой системы
     *
     * @param string $file абсолютный или относительный путь к файлу в файловой системе
     * @return void
     */
    public function removeSingleFileIfExist(string $file): void
    {
        file_exists($file) ? unlink($file) : false;

        $webpFile = $this->getWebpPath($file);
        if ($webpFile !== null && file_exists($webpFile)) {
            unlink($webpFile);
        }
    }

    /**
     * Конвертирует изображение png/jpeg в формат webp с оптимизацией без потери качества.
     * Исходный файл сохраняется, преобразованное изображение записывается рядом с ним.
     *
     * @param string $sourcePath путь к исходному изображению в файловой системе
     * @return string|null путь к созданному webp-файлу или null, если конвертация не выполнена
     */
    public function convertToWebp(string $sourcePath): ?string
    {
        if (!file_exists($sourcePath) || !function_exists('imagewebp')) {
            return null;
        }

        $mimeType = mime_content_type($sourcePath);

        switch ($mimeType) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($sourcePath);
                if ($image !== false) {
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                }
                break;
            default:
                return null;
        }

        if ($image === false) {
            return null;
        }

        $webpPath = $this->getWebpPath($sourcePath);
        if ($webpPath === null) {
            imagedestroy($image);
            return null;
        }

        $result = imagewebp($image, $webpPath, 100);
        imagedestroy($image);

        return $result ? $webpPath : null;
    }

    /**
     * Возвращает путь к webp-версии файла или null для неподдерживаемых форматов
     *
     * @param string $file путь к исходному файлу
     * @return string|null
     */
    public function getWebpPath(string $file): ?string
    {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if (!in_array($extension, ['png', 'jpg', 'jpeg'], true)) {
            return null;
        }

        return substr($file, 0, -(strlen($extension))) . 'webp';
    }

    /**
     * Генерирует путь к загружаемому файлу относительно каталога @frontend
     *
     * @param UploadedFile $file загружаемый файл
     * @param string $path путь для сохранения
     * @return string относительный путь к загружаемому файлу в директории @frontend
     */
    public static function setPath(UploadedFile $file, string $path): string
    {
        $img = uniqid() . '.' . $file->extension;
        $filePath = self::$frontendPath . $path . $img;
        return $filePath;
    }
}