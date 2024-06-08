<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GoldPrice extends BaseWidget
{
    protected function getStats(): array
    {
        // URL API và access token
        $url = 'https://www.goldapi.io/api/XAU/USD';
        $accessToken = 'goldapi-vbiim19lw5tb31h-io';

        // Tạo yêu cầu HTTP GET
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-access-token: ' . $accessToken
        ]);

        // Thực hiện yêu cầu và lấy kết quả
        $response = curl_exec($ch);
        curl_close($ch);

        // Giải mã JSON nhận được
        $data = json_decode($response, true);

        // Lấy giá vàng từ dữ liệu JSON
        $goldPrice = isset($data['price']) ? $data['price'] : 'N/A';

        // Trả về mảng Stat với giá vàng cập nhật
        return [
            Stat::make('Gold Price', $goldPrice . ' USD')
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
