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
        $tugasLapor = Post::get();
        $data = [
            $tugasLapor->where('bidang', 'reviu')->count(),
            $tugasLapor->where('bidang', 'keuangan')->count(),
        ];
        $label = [
            'reviu',
            'keuangan',
        ];

        return $this->chart->barChart()
            ->setTitle('Data Penugasan')
            ->setSubtitle('Data Penugasan Tahun 2023/2024')
            ->addData('reviu',[40,90,70,50])
            ->addData('audit',[30,75,60,40])
            ->setHeight(300)
            ->setLabels(['January','February','March','April']);
    }
}
