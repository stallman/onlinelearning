<?php


namespace App\Services\Interfaces\Admin\Imports;


use Illuminate\Http\UploadedFile;

interface TestImportServiceInterface
{
    public function import(UploadedFile $obFile, int $iTestId);
}
