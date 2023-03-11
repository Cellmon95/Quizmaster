<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use League\Csv\Reader;

class DataController extends Controller
{
    function uploadCSV(){
        //load the CSV document from a file path
        $csv = Reader::createFromPath('Quizmaster.csv')->setHeaderOffset(0);

        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords(); //returns all the CSV records as an Iterator object

        $questions = [];
        foreach ($csv as $record) {
            $question = new Question();
            $question->question = $record['question'];
            $question->alt1 = $record['alt1'];
            $question->alt2 = $record['alt2'];
            $question->alt3 = $record['alt3'];
            $question->alt4 = $record['alt4'];
            $question->category = $record['category'];
            $question->correct_answer = $record['correct_answer'];
            $question->save();
        }
        return redirect('/');
    }

    /*
    function testSpreadSheet(){

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }
    */
}
