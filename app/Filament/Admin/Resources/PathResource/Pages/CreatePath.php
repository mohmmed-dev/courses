<?php

namespace App\Filament\Admin\Resources\PathResource\Pages;

use App\Filament\Admin\Resources\PathResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePath extends CreateRecord
{
    protected static string $resource = PathResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
