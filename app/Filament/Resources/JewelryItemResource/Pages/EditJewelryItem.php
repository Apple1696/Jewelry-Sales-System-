<?php

namespace App\Filament\Resources\JewelryItemResource\Pages;

use App\Filament\Resources\JewelryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJewelryItem extends EditRecord
{
    protected static string $resource = JewelryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
