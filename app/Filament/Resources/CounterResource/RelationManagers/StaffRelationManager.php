<?php

namespace App\Filament\Resources\CounterResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\JewelryItem;

class StaffRelationManager extends RelationManager
{
    protected static string $relationship = 'staffs';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('item_id')
                //     // ->unique()
                //     ->options(function() {
                //         return JewelryItem::where("status", "<>", "sold")->pluck('name', 'id');
                //     }),
                // Forms\Components\TextInput::make('quantity')
                //     ->numeric()
                //     ->minValue(0),
                ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                // Tables\Columns\TextColumn::make('revenue')
                //     ->getStateUsing(function() {
                //         App\Models\Orders::with('details.item', 'promotion')
                //             ->whereYear('created_at', $year)
                //             ->where('counter_id', $this->counter_id)
                //             ->get()
                //             ->map(function($row) {
                //                 return $row->sum(function($order) {
                //                     return $order->price; // tính tổng doanh thu cho mỗi tháng
                //                 });
                //             })
                //             ->toArray();

                //     }),
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
