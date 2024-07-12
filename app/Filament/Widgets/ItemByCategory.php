<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Category;

class ItemByCategory extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $categories = Category::withCount('items')->get();
        return [
            'datasets' => [
                [
                    'label' => 'Item by Category',
                    'data' => $categories->pluck('items_count')->toArray(),
                    'borderColor' => [
                        'rgb(0, 255, 0)',
                        'rgb(0, 255, 0)',
                        'rgb(0, 255, 0)',
        
                      ],
                ],
       
            ],
            'labels' => Category::all()->pluck('name')->toArray(),

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
