<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Orders;
use Carbon\Carbon;

class MonthlyRevenue extends ChartWidget
{
    public string $user_id;

    protected static ?string $heading = 'Monthly Revenue';

    protected function getData(): array
    {
        // Lấy năm hiện tại
        $year = Carbon::now()->year;

        // Truy vấn dữ liệu từ bảng orders
        $monthlyRevenue = Orders::with('details.item', 'promotion')
            ->whereYear('created_at', $year)
            ->where('staff_id', $this->user_id)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            })
            ->map(function($row) {
                return $row->sum(function($order) {
                    return $order->price; // tính tổng doanh thu cho mỗi tháng
                });
            })
            ->toArray();

        // Khởi tạo mảng dữ liệu doanh thu 12 tháng với giá trị ban đầu là 0
        $data = array_fill(1, 12, 0);

        // Điền dữ liệu doanh thu vào mảng theo tháng
        foreach ($monthlyRevenue as $month => $total) {
            $data[(int)$month] = $total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Monthly revenue',
                    'data' => array_values($data),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
