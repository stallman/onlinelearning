<?php

namespace App\Http\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCharts;

use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Title;


class CourseAnketaExport implements FromCollection, WithColumnWidths, WithStyles//, WithCharts
{

    use Exportable;


    public function __construct(int $course_id) {

        $this->course_id = $course_id;
    }

    public function columnWidths(): array {
        return [
            'A' => 55,
            'B' => 60,
            'C' => 60,
            'D' => 60,
            'E' => 60,
            'F' => 60,
            'G' => 80,
        ];
    }

    public function styles(Worksheet $sheet) {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    /*public function charts() {

        $label      = [new DataSeriesValues('String', 'Worksheet!$B$1', null, 1)];
        $categories = [new DataSeriesValues('String', 'Worksheet!$B$1:$B$2', null, 2)];
        $values     = [new DataSeriesValues('String', 'Worksheet!$A$1:$A$2', null, 2)];

        $series = new DataSeries(DataSeries::TYPE_PIECHART, DataSeries::GROUPING_STANDARD,range(0, \count($values) - 1), $label, $categories, $values);
        $plot   = new PlotArea(null, [$series]);
                               
        $legend = new Legend();
        $chart  = new Chart('chart name', new Title('chart title'), $legend, $plot);

        return $chart;
    }*/


    public function collection() {

        $result = DB::select("select 'ФИО','Вопрос 1','Вопрос 2','Вопрос 3', 'Вопрос 4', 'Вопрос 5', 'Отзыв' union all select concat(COALESCE(users.surname,''),' ',COALESCE(users.name,''),' ',COALESCE(users.patronymic,'')),q1,q2,q3,q4,q5,q6 from courses,anketas,users where users.id=anketas.user_id and courses.id=anketas.course_id and courses.id=".$this->course_id);
        return collect($result);
    }

}