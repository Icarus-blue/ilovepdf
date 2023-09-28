<?php
require_once('./convert.php');

$public_id = "project_public_82bca4ed35bd5d2cf6cb08c93bcc5980_DK6mv7c694a2ab16aec88db129ce3c377779b";
$secret_key = "secret_key_9e0fa2a53f4332f54ee46be911f5e6f1_i1JAx858df117dc873d7a7a97b844436b15c2";
$pdfconverter = new PDFCONVERTER($public_id, $secret_key);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['flag'] == 0) {
        $targetDirectory = "./";
        $targetFile = $targetDirectory . basename($_FILES["excelFile"]["name"]);
        $uploadOk = 1;
        echo $targetFile;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if ($fileType !== "xlsx" && $fileType !== "xls") {
            echo "Only Excel files (XLS, XLSX) are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk === 0) {
            echo "File upload failed.";
        } else {
            if (move_uploaded_file($_FILES["excelFile"]["tmp_name"], $targetFile)) {
                $pdfconverter->ConvertExceltoPDF($targetFile);
            } else {
                echo "Error uploading file.";
            }
        }
    } else if ($_POST['flag'] == 1) {
        $pagenumberarr = $_POST['numarr'];
        $fname = $_POST['fname'];
        $fpath = 'C:\Users\Administrator\Downloads\exampel.pdf';
        $pdfconverter->SplitPDF($fpath, $pagenumberarr, $fname);
    } else if ($_POST['flag'] == 2) {
        $fnamestr = $_POST['fnamearr'];
        $array = explode(",", $fnamestr);
        $pdfconverter->MergePDF($array);
    } else {
    }
}
