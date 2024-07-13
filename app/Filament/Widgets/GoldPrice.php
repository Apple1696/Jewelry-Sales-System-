<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Setting;

class GoldPrice extends BaseWidget
{
    protected function getStats(): array
    {
        // Lấy giá vàng từ dữ liệu JSON
        $goldPrice = Setting::get('Gold Price');


        // Trả về mảng Stat với giá vàng cập nhật
        return [
            Stat::make('Gold Price', $goldPrice . ' VND')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([1,4,2,3,5,1,2,4,2])
                ->color('success'),
            Stat::make('Total Items', \App\Models\JewelryItem::count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                    ->chart([1,1])
                    ->color('success'),
            Stat::make('Total Gems', \App\Models\Gem::count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                    ->chart([1,1])
                    ->color('success'),
        ];
    }
}
