<?php

namespace App\Filament\Widgets;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Carbon;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class BlogPostsChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'ProjectStatus';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Project Status';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getTableQuery(): Builder
    {
        return Project::with('status')->latest()->take(5);
    }
    protected function getOptions(): array
    {
        $projects = Project::select('status')->get()->groupBy('status');

        $data = [];
        foreach ($projects as $status => $group) {
            $data[] = [
                'name' => $status,
                'data' => [$group->count()]
            ];
        }
    
        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => $data,
           
            'labels' => ['Active', 'Inprogress', 'Hold'],
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ];
       
    }
}
