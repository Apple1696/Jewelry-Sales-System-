<?php

namespace App\Filament\Resources\GemResource\Pages;

use App\Filament\Resources\GemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGem extends EditRecord
{
    protected static string $resource = GemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
