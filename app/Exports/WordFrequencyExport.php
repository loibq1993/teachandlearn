<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WordFrequencyExport implements FromArray, WithHeadings
{
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Word',
            'Times',
        ];
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $export = [];
        foreach ($this->data as $key => $value) {
            $export[] = [$value->word, $value->times];
        }
        return $export;
    }
}
