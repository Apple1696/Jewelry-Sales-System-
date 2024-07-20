<?php

namespace App\Filament\Resources\JewelryItemResource\Pages;

use App\Filament\Resources\JewelryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJewelryItems extends ListRecords
{
    protected static string $resource = JewelryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\JewelryItemResource\Widgets\ItemsOverview::class
        ];
    }
}
