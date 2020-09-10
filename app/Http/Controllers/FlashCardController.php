<?php

namespace App\Http\Controllers;

use App\Imports\FlashCardImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\FlashCardService;

class FlashCardController extends Controller
{
    protected $flashCardService;

    public function __construct(FlashCardService $flashCardService)
    {
        $this->flashCardService = $flashCardService;
    }

    public function index()
    {
        return view('flashCard.index');
    }

    public function import(Request $request)
    {
        $data = $this->flashCardService->import($request);
        return response()->json($data, 200);
    }

    public function export(Request $request)
    {
        $number = $request['number'] ?? 1;
        $fileName = pathinfo($request['filename'], PATHINFO_FILENAME);
        $data = json_decode($request['data'])->data;
        $newData = [];
        foreach ($data as $key_1 => $value) {
            foreach (collect($value)->toArray() as $key_2 => $item) {
                if ($number > 1) {
                    if ($key_1 % 2 === 0) {
                        $newData[$key_1][$key_2 . '_1'] = $item;
                    } else {
                        $newData[$key_1][$key_2 . '_2'] = $item;
                    }
                } else {
                    $newData[$key_1][$key_2] = $item;
                }
            }
        }
        $count = 0;
        $newArray = [];
        foreach ($newData as $key => $array) {
            foreach ($array as $i => $value) {
                if ($value === "" || $value === null) $array[$i] = "...";
            }
            if ($number > 1) {
                if ($key %2 === 0) {
                    $newArray[$count]  = $array;
                } else  {
                    $newArray[$count] = array_merge($newArray[$count], $array);
                    $count ++ ;
                }
            } else {
                $newArray[$key]  = $array;
            }
        }
        switch (strtolower($request['fileType'])) {
            case 'word':
                $fullFilePath = $this->flashCardService->exportWord($newArray, $number, $fileName);
                break;
            case 'pdf':
                $fullFilePath = $this->flashCardService->exportPDF($newArray, $number, $fileName);
                break;
            default:
                return false;
        }

        return response()->json([
            'name' => $fullFilePath,
            'file' => URL::to('/tmp/'.$fullFilePath)
        ]);

    }
}
