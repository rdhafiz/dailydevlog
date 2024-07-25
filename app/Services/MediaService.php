<?php

namespace App\Services;

use App\Models\Media;

class MediaService
{
    public function createMedia($filename, $mime_type, $file_type, $metadata = [])
    {
        return Media::create([
            'filename' => $filename,
            'mime_type' => $mime_type,
            'file_type' => $file_type,
            'metadata' => $metadata,
        ]);
    }

    public function getMediaById($id)
    {
        return Media::withTrashed()->find($id);
    }

    public function setTemporaryFlag(int $mediaId, $status = true)
    {
        $media = Media::find($mediaId);

        if ($media) {
            $media->is_temporary = $status;
            $media->save();
        }
    }


    public function deleteMedia(Media $media)
    {
        $media->forceDelete();
    }
}
