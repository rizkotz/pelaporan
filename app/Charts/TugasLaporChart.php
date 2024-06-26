<?php

namespace App\Charts;

use App\Models\Post;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TugasLaporChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $postCounts = Post::select('bidang', \DB::raw('count(*) as total'))
                          ->groupBy('bidang')
                          ->get()
                          ->pluck('total', 'bidang')
                          ->toArray();

        $labels = array_keys($postCounts);
        $data = array_values($postCounts);

        return $this->chart->barChart()
            ->setTitle('Data Penugasan')
            ->setSubtitle('Data Penugasan Tahun 2023/2024')
            ->addData('Jumlah Penugasan', $data)
            ->setHeight(300)
            ->setLabels($labels);
    }
}
