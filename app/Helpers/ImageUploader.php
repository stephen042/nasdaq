<?php

namespace App\Helpers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageUploader
{
    /**
     * Upload single or multiple images to Cloudinary.
     *
     * @param mixed $file Single TemporaryUploadedFile or array of files
     * @param string $folder Folder name on Cloudinary
     * @return string|array The Cloudinary URL(s)
     */
    public static function upload($file, $folder = 'proofs')
    {
        // If multiple files
        if (is_array($file)) {
            $urls = [];
            foreach ($file as $f) {
                $urls[] = self::uploadSingle($f, $folder);
            }
            return $urls;
        }

        // Single file
        return self::uploadSingle($file, $folder);
    }

    /**
     * Upload a single image to Cloudinary.
     */
    protected static function uploadSingle($file, string $folder): string
    {
        // Use getRealPath() to get the actual temp file path
        $uploadedFilePath = $file->getRealPath();

        // Upload to Cloudinary with folder option
        $uploaded = Cloudinary::upload($uploadedFilePath, [
            'folder' => $folder,
            'resource_type' => 'image', // ensure image upload
        ]);

        // Return the secure URL
        return $uploaded->getSecurePath();
    }
}
