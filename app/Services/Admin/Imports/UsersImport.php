<?php

namespace App\Services\Admin\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection//, WithUpserts
{
      
//    public function uniqueBy() {
//        return 'email';
//    }

    public function collection(Collection  $rows) {

        foreach ($rows as $row)  {

            if (!isset($row[0])) {
                return null;
            }

            $fio = explode(" ", $row[0]);
            if (!isset($fio[2])) $fio[2]='';

            try {
                $user = User::create([
                    'surname'       => $fio[0],
                    'name'          => $fio[1],
                    'patronymic'    => $fio[2],
                    'email'         => $row[1],
                    'password'      => Hash::make('Niioz2022'),
                ]);
                
                $user->assignRole('user');
            
            } catch(\Exception $e) {

                Log::debug('ERROR; skipping row');
            }
        }
    }
}