<?php
/**
 * Стабильный hashCallback для yii\web\AssetManager.
 *
 * Стандартный хеш папки опубликованных ассетов зависит от абсолютного пути и filemtime,
 * поэтому на локальной машине и на хостинге он разный. Из-за этого url() шрифтов и картинок,
 * "вшитые" в минифицированный CSS (yii asset), дают 404 на хостинге.
 * Здесь хеш считается только от пути относительно корня проекта.
 *
 * Используется в frontend/config/main.php и assets.php (должен быть одинаковым в обоих).
 */
return static function (string $path): string {
    $root = str_replace('\\', '/', (string) realpath(dirname(__DIR__, 2)));
    $path = is_file($path) ? dirname($path) : $path;
    $path = str_replace('\\', '/', (string) (realpath($path) ?: $path));

    if (str_starts_with($path, $root . '/')) {
        $path = substr($path, strlen($root));
    }

    return sprintf('%x', crc32($path));
};
