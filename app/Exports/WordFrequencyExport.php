<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class WordFrequencyExport implements FromArray
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return [
            [1, 2, 3],
            [4, 5, 6]
        ];
    }
}
