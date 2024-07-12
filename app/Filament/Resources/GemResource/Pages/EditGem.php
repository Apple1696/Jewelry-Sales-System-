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
<<<<<<< HEAD
            Actions\DeleteAction::make(),
=======
            Actions\DeleteAction::make()->confirm('Are you sure you want to delete this gem?'),
>>>>>>> a867b9f1ba5b51dce31140ad56ac1c495c9f196b
        ];
    }
}
