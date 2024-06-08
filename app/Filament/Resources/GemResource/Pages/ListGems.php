<?php

namespace App\Filament\Resources\GemResource\Pages;

use App\Filament\Resources\GemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGems extends ListRecords
{
    protected static string $resource = GemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
