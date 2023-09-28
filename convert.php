<?php
require_once('vendor/autoload.php');

use Ilovepdf\Ilovepdf;
use Ilovepdf\Tools\ExcelToPdfTask;

class PDFCONVERTER
{
    public $ilovepdf;
    public function __construct($param1, $param2)
    {
        $this->ilovepdf = new Ilovepdf($param1, $param2);
    }

    public function ConvertExceltoPDF($filepath)
    {
        $myTaskConvertOffice = $this->ilovepdf->newTask('officepdf');
        $myTaskConvertOffice->addFile($filepath);
        $myTaskConvertOffice->execute();
        $myTaskConvertOffice->download('C:\Users\Administrator\Downloads');
    }

    public function SplitPDF($filepath, $pagenumber, $fname)
    {
        $myTaskSplit = $this->ilovepdf->newTask('split');
        $file1 = $myTaskSplit->addFile($filepath);
        $rangestr = "";
        $pagenumberarr =  explode(",", $pagenumber);
        foreach ($pagenumberarr as  $key => $value) {
            $filename = 'pdf' . $key . '.pdf';
            $myTaskSplit->setOutputFilename($filename, $key);
            $rangestr .= $value . '-' . $value . ',';
        }
        $rangestr = rtrim($rangestr, ',');
        $myTaskSplit->setRanges($rangestr);
        $myTaskSplit->execute();
        $myTaskSplit->download('C:\Users\Administrator\Downloads');
        // $extractPath = 'spilit/';
        // $zip = new ZipArchive();
        // $zip->open('spilit/output.zip');
        // $zip->extractTo($extractPath);
        // $zip->close();
    }

    public function MergePDF($filenamearr)
    {
        $myTaskMerge = $this->ilovepdf->newTask('merge');
        foreach ($filenamearr as $key => $value) {
            $dir = 'C:/Users/Administrator/Downloads/';
            $filename = $dir . $value;
            $myTaskMerge->addFile($filename);
        }

        $myTaskMerge->execute();
        $myTaskMerge->download('C:\Users\Administrator\Downloads');
    }
}
