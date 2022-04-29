<?php

namespace App\Models;

use App\Models\Interfaces\DisplayedWhenSearching;
use App\Models\Traits\FindTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model implements DisplayedWhenSearching
{
    use HasFactory, FindTags;


    protected $fillable = [
        'title',
        'content',
        'image',
        'views',
    ];

    public function getSearchDescription(string $sFindStr): string
    {
        $arWords = explode(' ', strip_tags($this->getContentForSearch()));

        $i = 0;
        foreach ($arWords as $sWord){
            if(mb_stripos($sWord, $sFindStr) !== false){
                break;
            }
            $i++;
        }
        $i = $i >= 5 ? $i - 3 : $i;
        $sContent = implode(' ', array_slice($arWords, $i));
        $sString = implode(' ', array_slice(explode(' ', $sContent), 0,
                DisplayedWhenSearching::COUNT_OF_WORDS)) . '...';
        $sWithoutSpan = $this->removeTag('span', $sString);
        if($i === 0){
            return $this->wrapToTag('span', $sWithoutSpan, $sFindStr);
        }else{
            return '...' . $this->wrapToTag('span', $sWithoutSpan, $sFindStr);
        }
    }

    public function getContentForSearch(): string
    {
        return $this->content;
    }

    public function getTypeAttribute(): array
    {
        return [
            'title' => 'Новости',
            'route' => route('news'),
        ];
    }

    public function getRoute(): string
    {
        return route('front.news.show', ['id' => $this->id]);
    }

    public function getTitleForSearch(string $sFindStr): string
    {
        return $this->wrapToTag('span', $this->title, $sFindStr);
    }
}
