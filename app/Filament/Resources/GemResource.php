<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GemResource\Pages;
use App\Filament\Resources\GemResource\RelationManagers;
use App\Models\Gem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GemResource extends Resource
{
    protected static ?string $model = Gem::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = "Jewelry";

    protected static ?string $modelLabel = "Gem";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\Radio::make('is_gem_stone')
                    ->label('Is gem stone?')
                    ->boolean(),
                Forms\Components\FileUpload::make('image')
                    ->disk('public'),
                Forms\Components\TextInput::make('price'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                ->disk('public'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price')
                    ->money('VND'),
                Tables\Columns\TextColumn::make('is_gem_stone')
                    ->badge()
                    ->getStateUsing(function($record) {
                        return $record->is_gem_stone ? "Gem stone" : "Normal stone";
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Normal stone' => 'gray',
                        'Gem stone' => 'warning'
                    }),
            ])
            ->filters([
                SelectFilter::make('is_gem_stone')
                    ->options([
                        '1' => 'Gem stone',
                        '0' => 'Normal stone',
                    ])
                ], layout: FiltersLayout::Modal)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->paginated([ 20, 50, 100, 'all']);;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGems::route('/'),
            'create' => Pages\CreateGem::route('/create'),
            'edit' => Pages\EditGem::route('/{record}/edit'),
        ];
    }
}
