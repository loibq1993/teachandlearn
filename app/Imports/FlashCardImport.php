<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class FlashCardImport implements ToArray, WithHeadingRow
{
    public $data;
    /**
     * @return int
     */
    public function headings(): int
    {
        return 0;
    }

    public function array(array $data)
    {
        foreach ($data as $key_1 => $value) {
            foreach ($value as $key_2 => $item) {
                if ($key_2 === 'stt' && !is_null($item)) {
                    if ($key_1 !== "") {
                        $this->data[$key_1] = $value;
                    }
                }
            }
        }
        // TODO: Implement array() method.
    }

}
