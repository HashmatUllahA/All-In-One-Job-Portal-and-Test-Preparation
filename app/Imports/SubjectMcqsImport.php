<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\SubjectMcqs;

use Maatwebsite\Excel\Concerns\ToModel;
class SubjectMcqsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            dd('yes');
            SubjectMcqs::create([
                'question'      => $row[0],
                'optiona'       => $row[1],
                'optionb'       => $row[2],
                'optionc'       => $row[3],
                'optiond'       => $row[4],
                'correctOption' => $row[5],
            ]);
        }
    }
}