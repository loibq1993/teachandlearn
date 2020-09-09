<?php

namespace App\Services;

use App\Imports\FlashCardImport;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\Shared\ZipArchive;
use PhpOffice\PhpWord\TemplateProcessor;
use NcJoes\OfficeConverter\OfficeConverter;

/**
 * Class AccessHistoryService.
 */
class FlashCardService
{
    public function import($data)
    {
        $fileImport = $data->file('file')->store('temp');
        $path=storage_path('app').'/'.$fileImport;
        $import = new FlashCardImport;
        Excel::import($import, $path);

        return $import;
    }

    public function exportWord($data, $number, $fileName)
    {
        $fileDir = public_path('template/flashCard_'.$number.'.docx');
        $loopTimes = round(count($data)/$number);
        try {
            $templateProcessor = new TemplateProcessor($fileDir);
            $templateProcessor->cloneBlock('CLONEBLOCK', $loopTimes, true, false, $data);
            $templateProcessor->setValue('word_2', '');
            $templateProcessor->setValue('part_of_speech_2', '');
            $templateProcessor->setValue('pronunciation_2', '');
            $templateProcessor->setValue('definition_2', '');
            $templateProcessor->setValue('vietnamese_meaning_2', '');
            //test with TemplateCloneRow
        } catch (CopyFileException $e) {
            dd($e);
        } catch (CreateTemporaryFileException $e) {
            dd($e);
        }
        $fullFileName = $fileName.'.docx';
        $filePath = public_path('/tmp/'.$fileName.'.docx');
        $templateProcessor->saveAs($filePath);

        return $fullFileName;
    }

    public function exportPDF($newArray, $number, $fileName) {
        $fileStorage = public_path('/tmp/'.$this->exportWord($newArray, $number, $fileName));
        $fullfileName = $fileName.'.pdf';

        $converter = new OfficeConverter($fileStorage);
        $converter->convertTo($fullfileName);

        return $fullfileName;
    }
}
