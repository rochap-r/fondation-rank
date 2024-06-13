<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class Images
{
    /**
     * @param string $thumbnail_path
     * @param string $folder
     * @param string $new_file
     * @return void
     */
    public static function ImageProcess(string $thumbnail_path, string $folder, string $new_file, bool $ban = false): void
    {
        // Chemin vers le fichier original
        $originalFilePath = storage_path('app/public/' . $folder . $new_file);

        // Vérifie si le dossier de la miniature existe, sinon le crée
        if (!Storage::disk('public')->exists($thumbnail_path)) {
            Storage::disk('public')->makeDirectory($thumbnail_path);
        }

        // Crée une miniature carrée
        $squareThumbnailPath = storage_path('app/public/' . $thumbnail_path . 'thumb_' . $new_file);
        $image = Image::read($originalFilePath);
        $image->resizeDown(408, 200);
        $image->save($squareThumbnailPath);

        // Crée une image redimensionnée
        $resizedImagePath = storage_path('app/public/' . $thumbnail_path . 'resized_' . $new_file);
        $image = Image::read($originalFilePath);
        $image->resizeDown(840, 450);
        $image->save($resizedImagePath);
        if ($ban === true) {
            // Crée une image redimensionnée
            $resizedImagePath = storage_path('app/public/' . $thumbnail_path . 'banner_' . $new_file);
            $image = Image::read($originalFilePath);
            $image->resizeDown(1800, 980);
            $image->save($resizedImagePath);
        }
    }
}
