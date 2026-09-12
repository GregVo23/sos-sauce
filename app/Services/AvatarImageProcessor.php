<?php

namespace App\Services;

use Intervention\Image\ImageManager;

class AvatarImageProcessor
{
    public const SIZE = 300;
    public const QUALITY = 80;

    /**
     * Recadre/redimensionne un avatar en carré optimisé et l'enregistre.
     */
    public static function process(string $sourceAbsolutePath, string $destinationAbsolutePath): void
    {
        $destinationDir = dirname($destinationAbsolutePath);
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        ImageManager::gd()
            ->read($sourceAbsolutePath)
            ->cover(self::SIZE, self::SIZE)
            ->save($destinationAbsolutePath, quality: self::QUALITY);
    }
}
