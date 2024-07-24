<?php

namespace App\Filament\Widgets;

use App\Models\Counter;
use Filament\Widgets\ChartWidget;
use App\Models\Orders;
use Carbon\Carbon;

class MonthlyRevenue extends ChartWidget
{
    // public $filter = -1;

    protected static ?string $heading = 'Monthly Revenue';

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $year = Carbon::now()->year;

        $query = Orders::with('details.item', 'promotion')
            ->whereYear('created_at', $year);

        if ($activeFilter !== '0') {
            $query->where('counter_id', $activeFilter);
        }

        $orders = $query->get();

        $monthlyRevenue = $orders->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        })->map(function($row) {
            return $row->sum(function($order) {
                return $order->price; // tính tổng doanh thu cho mỗi tháng
            });
        })->toArray();

        $data = array_fill(1, 12, 0);

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

    protected function getFilters(): ?array
    {
        $filters = Counter::all()->pluck('name', 'id')->toArray();
        $filters = [0 => "Tất cả"] + $filters; // Đặt "Tất cả" với giá trị 0
        return $filters;
    }

    protected function getType(): string
    {
        return 'line';
    }
}

