<?php


namespace App\Services\Front;


use App\Models\Block;
use App\Models\Course;

class BlockService
{

    /**
     * Возвращает ссылку на следующий блок в курсе
     * @param Course $obCourse
     * @param Block $obBlock
     * @return string
     */
    public function getNextRoute(Course $obCourse, Block $obBlock): string
    {
        foreach($obCourse->blocks as $obParentBlock){
            if($obParentBlock->order - 1 === $obBlock->order){
                return route('profile.courses.show.block',
                    ['id' => $obCourse->id, 'blockId' => $obParentBlock->id]);
            }
        }
        return '';
    }

    /**
     * Возвращает ссылку на предыдущий блок в курсе
     * @param Course $obCourse
     * @param Block $obBlock
     * @return string
     */
    public function getPrevRoute(Course $obCourse, Block $obBlock): string
    {
        foreach($obCourse->blocks as $obParentBlock){
            if($obParentBlock->order + 1 === $obBlock->order){
                return route('profile.courses.show.block',
                    ['id' => $obCourse->id, 'blockId' => $obParentBlock->id]);
            }
        }
        return '';
    }
}
