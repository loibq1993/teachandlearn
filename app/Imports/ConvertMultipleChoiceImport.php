<?php


namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ConvertMultipleChoiceImport implements ToArray, WithStartRow
{
    public $data;
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 3;
    }

    public function array(array $array)
    {
        foreach($array as $key => $value) {
            foreach ($value as $key_2 => $item) {
                if ($key_2 === 0 && $item === null) break;
                if ($key_2 <= 6) {
                    $this->data[$key][$key_2] = $item;
                }
            }
        }
    }
}
