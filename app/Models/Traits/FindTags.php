<?php


namespace App\Models\Traits;


trait FindTags
{
    protected function removeTag(string $sTagName, string $sString) : string
    {
        $sString = str_replace("&nbsp;",' ',$sString);
        $sString = str_replace(".",'. ',$sString);
        $sString = str_replace("?",'? ',$sString);
        $sString = str_replace(",",', ',$sString);
        $sString = str_replace("\r\n",' ',$sString);
        return strip_tags($sString);
    }

    protected function wrapToTag(string $sTagName, string $sString, string $sFindStr) : string
    {

        $sFindStrUcfirst = mb_strtoupper(mb_substr($sFindStr, 0, 1)).mb_substr($sFindStr, 1);

        $arWords = explode(' ', $sString);
        foreach ($arWords as &$sWord){
            if(mb_strpos($sWord, $sFindStr) !== false || mb_strpos($sWord, $sFindStrUcfirst) !== false){
                $sWord = "<{$sTagName}>{$sWord}</{$sTagName}>";
            }
        }

        $sResult = implode(' ', $arWords);

        return $sResult;
    }

}
