<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ConvertMultipleChoiceService;
use Illuminate\Support\Facades\URL;

class ConvertMultipleChoiceController extends Controller
{
    protected $convertMultipleChoice;

    public function __construct(ConvertMultipleChoiceService $convertMultipleChoice)
    {
        $this->convertMultipleChoice = $convertMultipleChoice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('convertMultipleChoice.index');
    }

    public function import(Request $request)
    {
        $data = $this->convertMultipleChoice->import($request)->data;
        $fileName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
        $this->convertMultipleChoice->exportWord($data, $fileName);
        return response()->json($fileName, 200);
    }

    public function export(Request $request)
    {
        $fileName = substr($request['data'], 1, -1).'.docx';
        $response = [
            'name' => $fileName,
            'file' => URL::to('/tmp/'.$fileName)
        ];

        return response()->json($response);
    }
}
