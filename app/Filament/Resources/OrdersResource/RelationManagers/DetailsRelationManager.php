<?php

namespace App\Filament\Resources\OrdersResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\JewelryItem;

class DetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'details';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    // ->unique()
                    ->options(function() {
                        return JewelryItem::where("status", "<>", "sold")->pluck('name', 'id');
                    }),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->minValue(0),
                ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('item.image')
                ->disk('public'),
            Tables\Columns\TextColumn::make('item.name')
                ->label('Name'),
            Tables\Columns\TextColumn::make('item.gold_weight')
                ->label('Hold Weight'),
            Tables\Columns\TextColumn::make('item.price')
                ->label('Price')
                ->money('VND'),
            Tables\Columns\TextColumn::make('item.status')
                ->badge()
                ->label('Status')
                ->color(fn (string $state): string => match ($state) {
                    'draft' => 'gray',
                    'selling' => 'warning',
                    'sold' => 'success',
                    'rebuy' => 'success',
                }),
            Tables\Columns\TextColumn::make('quantity'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
