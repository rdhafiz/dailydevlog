<?php

// app/Http/Controllers/Api/MediaController.php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaUploadRequest;
use App\Services\MediaService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    private $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function store(MediaUploadRequest $request)
    {
        $request->validated();
        $file = $request->file('file');
        $fileType = Str::startsWith($file->getMimeType(), 'image') ? 'image' : 'video';

        $newName = Storage::disk('public')->putFile('media', $file);
        $metadata = [
            'filename' => $file->getClientOriginalName(),
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'mimeType' => $file->getMimeType(),
        ];


        $media = $this->mediaService->createMedia(basename($newName), $file->getMimeType(), $fileType, $metadata);


        // Get the full URL for the stored file
        $media['full_path'] = Storage::disk('public')->url($newName);

        return response()->json($media, 201);
    }

    public function show($id)
    {
        $media = $this->mediaService->getMediaById($id);

        if (!$media) {
            return response()->json(['error' => 'Media not found'], 404);
        }

        return Storage::disk('public')->response("media/{$media->filename}");
    }

    public function destroy($id)
    {
        $media = $this->mediaService->getMediaById($id);

        if (!$media) {
            return response()->json(['error' => 'Media not found'], 404);
        }

        $this->mediaService->deleteMedia($media);

        // Delete the associated file from storage
        Storage::disk('public')->delete("media/{$media->filename}");

        return response()->json(['message' => 'Media deleted successfully'], 200);
    }
}
