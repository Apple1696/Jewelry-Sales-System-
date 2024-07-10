<?php

namespace App\Filament\Resources\RebuyResource\Pages;

use App\Filament\Resources\RebuyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRebuy extends EditRecord
{
    protected static string $resource = RebuyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
