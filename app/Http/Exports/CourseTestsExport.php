<?php

namespace App\Http\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CourseTestsExport implements FromCollection, WithColumnWidths, WithStyles
{

    use Exportable;

    public function __construct(int $course_id) {

        $this->course_id = $course_id;
    }

    public function columnWidths(): array {
        return [
            'A' => 55,
            'B' => 10,
            'C' => 23,
            'D' => 12,
            'E' => 20,
        ];
    }

    public function styles(Worksheet $sheet) {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }


    public function collection() {

        $result = DB::select("SELECT 'ФИО', 'Баллы', 'Процент прохождения', 'Результат' UNION ALL select concat(COALESCE(users.surname,''),' ',COALESCE(users.name,''),' ',COALESCE(users.patronymic,'')) , sum(is_right),sum(is_right)/count(is_right)*100, IF(sum(is_right)>=minimal_right_questions, 'Сдан', 'Не сдан') from question_user,questions,courses,tests,users where  users.id=question_user.user_id and question_user.question_id=questions.id and questions.test_id=courses.test_id and courses.test_id=tests.id and courses.id=".$this->course_id." group by question_user.user_id;");
        return collect($result);
    }

}