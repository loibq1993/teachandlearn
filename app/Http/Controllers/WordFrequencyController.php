<?php

namespace App\Http\Controllers;

use App\Exports\WordFrequencyExport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\IOFactory;

class WordFrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('wordFrequency.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function count($text)
    {
        $arrayCount = array_count_values(str_word_count($text, 1));
        $data = [];
        $i = 0;
        foreach ($arrayCount as $key => $value) {
            $data [$i] = ['word' => $key, 'times' => $value];
            $i++;
        }
        return $data;
    }

    public function export(Request $request)
    {
        $data = (array)json_decode($request->data);
        $fileName = $request->filename;
        ob_end_clean(); // this
        ob_start(); // and this
        $myFile = Excel::raw(new WordFrequencyExport($data), \Maatwebsite\Excel\Excel::XLS);
        $response =  array(
            'name' => $fileName, //no extention needed
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );
        return response()->json($response);
    }

    public function  import(Request $request)
    {
        $phpWord = IOFactory::load($request->file('file')->path());
        $sections = $phpWord->getSections();
        $text = '';
        foreach ($sections as $key => $value) {
            $sectionElement = $value->getElements();
            foreach ($sectionElement as $elementKey => $elementValue) {
                if ($elementValue instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    $secondSectionElement = $elementValue->getElements();
                    foreach ($secondSectionElement as $secondSectionElementKey => $secondSectionElementValue) {
                        if ($secondSectionElementValue instanceof \PhpOffice\PhpWord\Element\Text) {
                            $text = $text.$secondSectionElementValue->getText();
                        }
                    }
                }
            }
        }

        return response()->json($this->count($text), 200);
    }

    public function submitInput(Request $request)
    {
        return $this->count($request->text);
    }
}
