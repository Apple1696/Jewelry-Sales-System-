<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdersResource\Pages;
use App\Filament\Resources\OrdersResource\RelationManagers;
use App\Models\Orders;
use App\Models\User;
use App\Models\JewelryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Orders";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(12)
                    ->schema([
                        Forms\Components\Select::make('order_type')
                            ->options([
                                "rebuy" => "Rebuy",
                                "sell" => "Sell"
                            ])
                            ->columnSpan(4),
                        Forms\Components\Select::make('user_id')
                            ->options(function() {
                                return User::all()->pluck("name", "id")->toArray();
                            })
                            ->columnSpan(4),
                        Forms\Components\TextInput::make('total_price')
                            ->numeric()
                            ->minValue(0)
                            ->columnSpan(4),
                        // Forms\Components\Repeater::make('details')
                        //     ->relationship()
                        //     ->schema([
                        //         Forms\Components\Select::make('item_id')
                        //             ->options(function() {
                        //                 return JewelryItem::all()->pluck('name', 'id');
                        //             }),
                        //         Forms\Components\TextInput::make('quantity')
                        //             ->numeric()
                        //             ->minValue(0),
                        //     ])
                        //     ->columnSpan(12)
                        //     ->columns(2)
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label("Customer"),
                Tables\Columns\TextColumn::make('staff.name')
                    ->label("Staff"),
                Tables\Columns\TextColumn::make('order_type')
                    ->label("Type"),
                Tables\Columns\TextColumn::make('price')
                    ->label("Type")
                    ->getStateUsing(function($record) {
                        $details = $record->details;
                        $price = 0;
                        foreach($details as $detail) {
                            $price += $detail->item->price * $detail->quantity;
                        }
                        return $price;
                    })
                    ->money('VND'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Created At"),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label("Updated At")
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\OrdersResource\RelationManagers\DetailsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrders::route('/create'),
            'edit' => Pages\EditOrders::route('/{record}/edit'),
        ];
    }
}
