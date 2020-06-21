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
        $data = $this->submitInput($request);
        $fileName = 'document.xlsx';
        if (isset($request->file)) {
            $fileName = '';
        }
        return Excel::download(new WordFrequencyExport, $fileName);
    }

    public function  import(Request $request)
    {
        $phpWord = IOFactory::createReader('Word2007')->load($request->file('file')->path());
        dd($phpWord);
    }

    public function submitInput(Request $request)
    {
        return $this->count($request->text);
    }
}
