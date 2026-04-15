<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('site_logo')
            ->singleFile();

        $this
            ->addMediaCollection('site_logo_small')
            ->singleFile();

        $this
            ->addMediaCollection('site_logo_large')
            ->singleFile();
    }
}
