<?php

namespace App\Console\Commands;

use App\Services\MealImageProcessor;
use Illuminate\Console\Command;

class OptimizeMealImages extends Command
{
    /**
     * @var string
     */
    protected $signature = 'meals:optimize-images {--force : Régénérer même si les fichiers optimisés existent déjà}';

    /**
     * @var string
     */
    protected $description = "Archive les images de plats originales et génère leurs versions optimisées (card/detail)";

    public function handle()
    {
        $mealsDir = storage_path('app/public/meals');
        $originalDir = $mealsDir . DIRECTORY_SEPARATOR . 'original';

        if (!is_dir($mealsDir)) {
            $this->error("Le dossier {$mealsDir} n'existe pas.");
            return self::FAILURE;
        }

        if (!is_dir($originalDir)) {
            mkdir($originalDir, 0755, true);
        }

        // Les fichiers restés à la racine de meals/ sont les originaux non traités.
        $files = array_filter(glob($mealsDir . DIRECTORY_SEPARATOR . '*'), 'is_file');

        if (empty($files) && !$this->option('force')) {
            $files = array_filter(glob($originalDir . DIRECTORY_SEPARATOR . '*'), 'is_file');
        }

        if (empty($files)) {
            $this->info('Aucune image à traiter.');
            return self::SUCCESS;
        }

        $totalBefore = 0;
        $totalAfter = 0;

        foreach ($files as $path) {
            $filename = basename($path);
            $originalPath = $originalDir . DIRECTORY_SEPARATOR . $filename;

            // Archive l'original s'il n'y est pas déjà.
            if ($path !== $originalPath) {
                rename($path, $originalPath);
            }

            $cardPath = $mealsDir . '/card/' . $filename;
            $detailPath = $mealsDir . '/detail/' . $filename;

            if (!$this->option('force') && file_exists($cardPath) && file_exists($detailPath)) {
                $this->line("Déjà optimisé : {$filename}");
                continue;
            }

            $before = filesize($originalPath);

            MealImageProcessor::process($originalPath, $filename);

            $after = filesize($cardPath) + filesize($detailPath);
            $totalBefore += $before;
            $totalAfter += $after;

            $this->info(sprintf(
                '%s : %s -> card+detail %s (-%.0f%%)',
                $filename,
                $this->formatBytes($before),
                $this->formatBytes($after),
                (1 - $after / $before) * 100
            ));
        }

        if ($totalBefore > 0) {
            $this->newLine();
            $this->info(sprintf(
                'Total traité : %s -> %s',
                $this->formatBytes($totalBefore),
                $this->formatBytes($totalAfter)
            ));
        }

        return self::SUCCESS;
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1024 * 1024) {
            return round($bytes / (1024 * 1024), 2) . ' Mo';
        }
        return round($bytes / 1024, 1) . ' Ko';
    }
}
