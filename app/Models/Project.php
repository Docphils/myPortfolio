<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'media',
        'link',
    ];

    public function mediaItems(): array
    {
        return array_values(array_filter(array_map(
            static fn (string $media): string => trim($media),
            explode(',', (string) $this->media)
        )));
    }

    public function imageMedia(): array
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        return array_values(array_filter(
            $this->mediaItems(),
            static fn (string $media): bool => in_array(strtolower(pathinfo($media, PATHINFO_EXTENSION)), $imageExtensions, true)
        ));
    }

    public function videoMedia(): array
    {
        return array_values(array_filter(
            $this->mediaItems(),
            static fn (string $media): bool => strtolower(pathinfo($media, PATHINFO_EXTENSION)) === 'mp4'
        ));
    }
}
