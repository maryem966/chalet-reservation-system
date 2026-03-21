<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Laminas\Diactoros\UploadedFile;

class UploadComponent extends Component
{
    /**
     * Handle the file upload and return the filename on success.
     * 
     * @param UploadedFile|null $file The uploaded file object
     * @param string $destinationDir The directory relative to WWW_ROOT/img/
     * @return string|null The unique filename or null if upload failed/ignored
     */
    public function handleImageUpload(?UploadedFile $file, string $destinationDir): ?string
    {
        if ($file && $file->getError() === UPLOAD_ERR_OK) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9.\-_]/', '', $file->getClientFilename());
            $filepath = WWW_ROOT . 'img' . DS . $destinationDir . DS . $filename;
            
            // Ensure directory exists
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0777, true);
            }

            $file->moveTo($filepath);
            return $filename;
        }

        return null;
    }
}
