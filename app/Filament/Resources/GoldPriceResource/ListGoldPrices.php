<?php

namespace App\Filament\Resources\GoldPriceResource\Pages;
use App\Filament\Resources\GoldPriceResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;
class ListGoldPrices extends ListRecords
{
    protected static string $resource = GoldPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
