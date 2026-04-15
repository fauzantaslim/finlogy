<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    /**
     * Populate the cover_image field with the current media URL
     * so the user can see the existing cover on the edit form.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // We keep cover_image empty — FileUpload handles display via its own state.
        // The existing cover is shown separately in the form via the preview.
        return $data;
    }

    /**
     * After saving, replace the cover image in Spatie Media Library
     * if a new file was uploaded.
     */
    protected function afterSave(): void
    {
        $this->attachCoverImage($this->record);
    }

    private function attachCoverImage(\App\Models\Post $post): void
    {
        $value = $this->data['cover_image'] ?? null;

        // FileUpload returns an array of paths even for a single file
        $path = is_array($value) ? (array_values($value)[0] ?? null) : $value;

        if ($path && Storage::disk('public')->exists($path)) {
            $post->addMediaFromDisk($path, 'public')
                ->toMediaCollection('post_covers');

            Storage::disk('public')->delete($path);
        }
    }
}
