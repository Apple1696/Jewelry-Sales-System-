<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RevenueResource\Pages;
use App\Models\Orders;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class RevenueResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = "Reports";

    protected static ?string $modelLabel = "Revenue";

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('price')
                    ->label('Revenue')
                    ->money('VND')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('counter.name')
                    ->label('Counter')
                    ->sortable(),
                Tables\Columns\TextColumn::make('staff.name')
                    ->label('Staff')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('daily')
                    ->query(fn (Builder $query): Builder => $query->whereDate('created_at', Carbon::today()))
                    ->label('Today'),

                Filter::make('monthly')
                    ->query(fn (Builder $query): Builder => $query->whereMonth('created_at', Carbon::now()->month))
                    ->label('This Month'),

                Filter::make('yearly')
                    ->query(fn (Builder $query): Builder => $query->whereYear('created_at', Carbon::now()->year))
                    ->label('This Year'),

                Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Start Date'),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('End Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['end_date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date)
                            );
                    })
                    ->label('Date Range'),

                SelectFilter::make('counter_id')
                    ->relationship('counter', 'name')
                    ->label('Counter'),

                SelectFilter::make('staff_id')
                    ->relationship('staff', 'name')
                    ->label('Staff'),
            ], layout: FiltersLayout::AboveContent)
            ->actions([])
            ->bulkActions([])
            ->paginated([5, 10, 20, 'all']);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRevenues::route('/'),
        ];
    }
}
