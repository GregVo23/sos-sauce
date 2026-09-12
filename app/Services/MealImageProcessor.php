<?php

namespace App\Services;

use Intervention\Image\ImageManager;

class MealImageProcessor
{
    public const CARD_WIDTH = 480;
    public const DETAIL_WIDTH = 1200;

    public const CARD_QUALITY = 75;
    public const DETAIL_QUALITY = 82;

    /**
     * Generate the "card" (list/carousel thumbnail) and "detail" (hero image)
     * variants of a meal picture from its original file.
     */
    public static function process(string $originalAbsolutePath, string $filename): void
    {
        $manager = ImageManager::gd();

        $cardDir = storage_path('app/public/meals/card');
        $detailDir = storage_path('app/public/meals/detail');

        if (!is_dir($cardDir)) {
            mkdir($cardDir, 0755, true);
        }
        if (!is_dir($detailDir)) {
            mkdir($detailDir, 0755, true);
        }

        $manager->read($originalAbsolutePath)
            ->scaleDown(width: self::CARD_WIDTH)
            ->save($cardDir . DIRECTORY_SEPARATOR . $filename, quality: self::CARD_QUALITY);

        $manager->read($originalAbsolutePath)
            ->scaleDown(width: self::DETAIL_WIDTH)
            ->save($detailDir . DIRECTORY_SEPARATOR . $filename, quality: self::DETAIL_QUALITY);
    }
}
