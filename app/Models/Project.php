<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'media',
        'link',
        'is_published',
        'is_featured',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function caseStudies(): HasMany
    {
        return $this->hasMany(CaseStudy::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->where(function (Builder $builder): void {
                $builder->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

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
