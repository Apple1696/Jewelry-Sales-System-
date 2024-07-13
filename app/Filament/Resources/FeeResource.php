<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeeResource\Pages;
use App\Models\Fee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;

class FeeResource extends Resource
{
    protected static ?string $model = Fee::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = "Jewelry";

    protected static ?string $modelLabel = "Fee";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('wage')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('charge_rate')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('wage')->sortable(),
                Tables\Columns\TextColumn::make('charge_rate')->sortable(),
            ])
            ->filters([
                // Add any filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListFees::route('/'),
            'create' => Pages\CreateFee::route('/create'),
            'edit' => Pages\EditFee::route('/{record}/edit'),
        ];
    }
}
