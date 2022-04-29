<?php


namespace App\Models\Interfaces;


use App\Models\Traits\FindTags;

/**
 * Интерфейс чтобы была возможность отображать результаты поиска на странице поиска
 * @package App\Models\Interfaces
 */
interface DisplayedWhenSearching
{

    const COUNT_OF_WORDS = 15;

    public function getSearchDescription(string $sFindStr): string;
    public function getContentForSearch() : string;
    public function getTitleForSearch(string $sFindStr) : string;
    public function getRoute():string;
    public function getTypeAttribute() : array;
}
