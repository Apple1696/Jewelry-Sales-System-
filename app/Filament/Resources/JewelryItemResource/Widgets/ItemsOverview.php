<?php

namespace App\Filament\Resources\JewelryItemResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\JewelryItem as Item;

class ItemsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Draft Items', Item::where('status', 'draft')->count())
                // ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([1,1])
                ->color('primary'),
            Stat::make('Selling Items', Item::where('status', 'selling')->count())
                // ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([1,1])
                ->color('success'),
            Stat::make('Sold Items', Item::where('status', 'sold')->count())
                // ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([1,1])
                ->color('success'),
            Stat::make('Rebuy', Item::where('status', 'rebuy')->count())
                // ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([1,1])
                ->color('success'),
        ];
    }
}
