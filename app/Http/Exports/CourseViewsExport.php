<?php

namespace App\Http\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CourseViewsExport implements FromCollection, WithColumnWidths, WithStyles
{

    use Exportable;

    public function __construct(int $course_id) {

        $this->course_id = $course_id;
    }

    public function columnWidths(): array {
        return [
            'A' => 55,
            'B' => 20,
        ];
    }

    public function styles(Worksheet $sheet) {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }


    public function collection() {

        $result = DB::select("SELECT 'ФИО','Последний визит' UNION ALL select concat(COALESCE(users.surname,''),' ',COALESCE(users.name,''),' ',COALESCE(users.patronymic,'')) , last_view from question_user,courses,users,course_user where course_user.user_id=users.id and course_user.course_id=courses.id  and courses.id=".$this->course_id." group by course_user.user_id;");
        return collect($result);
    }

}