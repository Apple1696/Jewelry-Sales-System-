<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RebuyResource\Pages;
use App\Filament\Resources\RebuyResource\RelationManagers;
use App\Models\Counter;
use App\Models\Fee;
use App\Models\GoldPrice;
use App\Models\Rebuy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\JewelryItem;
use App\Models\User;
use App\Models\Setting;

class RebuyResource extends Resource
{
    protected static ?string $model = Rebuy::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';

    protected static ?string $navigationGroup = "Jewelry";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->options(function() {
                        return JewelryItem::where("status", "sold")->pluck("name", "id")->toArray();
                    })
                    ->live()
                    ->afterStateUpdated(function ($set, $state) {
                        $goldPrice = (int) Setting::where('key', 'Gold Price')->first()->value;

                        $item = JewelryItem::find($state);
                        $fee = (int) Setting::where('key', 'Rebuy Percentant')->first()->value;
                        $price = $item->gold_weight * $goldPrice;
                        foreach ($item->gems as $gem) {
                            if ($gem->is_gem_stone) {
                                $price += ($fee / 100) * $gem->price;
                            }
                        }
                        $set("price", $price);
                    })              
                    ->columnSpan(4),
                Forms\Components\Hidden::make('staff_id')
                    ->default(function() {
                        return auth()->user()->id;
                    })
                    ->columnSpan(4),
                Forms\Components\TextInput::make('price')
                    // ->numeric()
                    // ->disabled()
                    ->columnSpan(4),
                    Forms\Components\Select::make('counter_id')
                    ->label('Counter Name')
                    ->options(function() {
                        return Counter::pluck('name', 'id')->toArray();
                    })
                    ->required()
                    ->columnSpan(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')
                    ->label("Item"),
                Tables\Columns\TextColumn::make('staff.name')
                    ->label("Staff"),
                Tables\Columns\TextColumn::make('price')
                    ->label("Price")
                    ->money('VND'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRebuys::route('/'),
            'create' => Pages\CreateRebuy::route('/create'),
            'edit' => Pages\EditRebuy::route('/{record}/edit'),
        ];
    }
}
