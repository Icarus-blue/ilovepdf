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
        $myTaskConvertOffice->download('pdf_converted');
    }

    public function SplitPDF($filepath)
    {
        $myTaskSplit = $this->ilovepdf->newTask('split');
        $file1 = $myTaskSplit->addFile($filepath);
        $myTaskSplit->setOutputFilename('pdf1.pdf', 1);
        $myTaskSplit->setOutputFilename('pdf2.pdf', 2);
        $myTaskSplit->setOutputFilename('pdf3.pdf', 3);
        $myTaskSplit->setRanges('1-1,2-2,3-4');
        $myTaskSplit->execute();
        $myTaskSplit->download('spilit');
        $extractPath = 'spilit/';
        $zip = new ZipArchive();
        $zip->open('spilit/output.zip');
        $zip->extractTo($extractPath);
        $zip->close();
    }

    public function MergePDF($filepath1, $filepath2, $filepath3)
    {
        $myTaskMerge = $this->ilovepdf->newTask('merge');
        $myTaskMerge->addFile($filepath1);
        $myTaskMerge->addFile($filepath2);
        $myTaskMerge->addFile($filepath3);
        $myTaskMerge->execute();
        $myTaskMerge->download('merge_folder');
    }
}
