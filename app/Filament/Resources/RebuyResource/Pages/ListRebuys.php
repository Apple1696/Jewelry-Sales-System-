<?php

namespace App\Filament\Resources\RebuyResource\Pages;

use App\Filament\Resources\RebuyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRebuys extends ListRecords
{
    protected static string $resource = RebuyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
