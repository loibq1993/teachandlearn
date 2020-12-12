<?php

namespace App\Services;

use App\Imports\ConvertMultipleChoiceImport;
use DOMDocument;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\Shared\ZipArchive;
use PhpOffice\PhpWord\Style\Paper;
use PhpOffice\PhpWord\TemplateProcessor;
use NcJoes\OfficeConverter\OfficeConverter;
use PhpOffice\PhpWord\ComplexType\TblWidth as TblWidthComplexType;
use PhpOffice\PhpWord\SimpleType\TblWidth;
/**
 * Class AccessHistoryService.
 */
class ConvertMultipleChoiceService
{
    public function import($data)
    {
        $fileImport = $data->file('file')->store('temp');
        $path=storage_path('app').'/'.$fileImport;
        $import = new ConvertMultipleChoiceImport;
        Excel::import($import, $path);

        return $import;
    }

    public function exportWord($data, $fileName): string
    {
        $filePath = public_path('/tmp/'.$fileName.'.docx');
        $alphabet = range('A', 'Z');
        $count = 0;
        $paper = new Paper();
        $paper->setSize('A4');  // or 'Legal', 'A4' ...
        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontSize(11);
        $phpWord->setDefaultFontName('Calibri');
        $phpWord->setDefaultParagraphStyle([
            'spacing' => 1.15,
        ]);
        libxml_use_internal_errors(true);
        $section = $phpWord->addSection([
            'marginLeft' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(0.5),
            'marginRight' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(0.5),
            'marginTop' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(0.5),
            'marginBottom' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(0.5),
        ]);
        $phpWord->addTitleStyle(
            1,
            ['bold' => true],
            [ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]
        );
        $section->addTitle(strtoupper($fileName), 1);
        $section->addTextBreak();
        foreach ($data as $value) {
            $answer = array_slice($value, 2);
            $countValue = count(array_filter($answer));
            $maxAnswerLen = max(array_map('strlen', $answer));
            $section->addText($value[0].'. '.$value[1]);
            $table = $section->addTable([
                'indent' =>  new TblWidthComplexType(
                    \PhpOffice\PhpWord\Shared\Converter::inchToTwip(0.5)
                    , TblWidth::TWIP),
                'marginRight' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(0.5),
            ]);
            if ($maxAnswerLen < 30 && $countValue === 5) {
                $this->answer(array_filter($answer), $alphabet, $count, $table, 3);
            } elseif ($maxAnswerLen < 50) {
                if ($maxAnswerLen < 25) {
                    $this->answer(array_filter($answer), $alphabet, $count, $table, 4);
                } else {
                    $this->answer(array_filter($answer), $alphabet, $count, $table, 2);
                }
            } else {
                $this->answer(array_filter($answer), $alphabet, $count, $table);
            }
            $section->addTextBreak();
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filePath);

        return $fileName;
    }

    public function answer($value, $alphabet, $count, $table, $col = 1)
    {
        switch ($col) {
            case 2:
                foreach($value as $key => $item) {
                    if ($key === 0 || $key === 2) {
                        $table->addRow();
                    }
                    $table->addCell(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(3.5))->addText($alphabet[$count++].'. '.$item);
                }
                break;
            case 3:
                foreach($value as $key => $item) {
                    if ($key === 0 || $key === 3) {
                        $table->addRow();
                    }
                    $table->addCell(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(2))->addText($alphabet[$count++] . '. ' . $item);
                }
                break;
            case 4:
                $table->addRow();
                foreach($value as $key => $item) {
                    $table->addCell(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(1.5))->addText($alphabet[$count++] . '. ' . $item);
                }
                break;
            default:
                foreach($value as $key => $item) {
                    $table->addRow();
                    $table->addCell()->addText($alphabet[$count++] . '. ' . $item);
                }
                break;
        }

        return $table;
    }

}
