<?php
 
namespace App\Filament\Pages;
 
class Dashboard extends \Filament\Pages\Dashboard
{

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\GoldPrice::class,
            \App\Filament\Widgets\MonthlyRevenue::class,
            \App\Filament\Widgets\ItemByCategory::class,
            \App\Filament\Widgets\LatestOrders::class,
        ];
    }
}