<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\SpreadsheetReader;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadFile(Request $request){

        $allowedFileType = [
            'application/vnd.ms-excel',
            'text/xls',
            'text/xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        // $file = $request->file('file');

// if (in_array($_FILES["file"]["type"], $allowedFileType)) {
    
    if (true) {

        $targetPath = public_path('hello world11.xlsx');
        // move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 0; $i <= $sheetCount; $i ++) {
            // $name = "";
            if (isset($spreadSheetAry[$i][0])) {
                echo($spreadSheetAry[$i][0]);
            }
            // $description = "";
            if (isset($spreadSheetAry[$i][1])) {
                echo($spreadSheetAry[$i][1]);
            }

            // if (! empty($name) || ! empty($description)) {
            //     $query = "insert into tbl_info(name,description) values(?,?)";
            //     $paramType = "ss";
            //     $paramArray = array(
            //         $name,
            //         $description
            //     );
            //     $insertId = $db->insert($query, $paramType, $paramArray);
            //     // $query = "insert into tbl_info(name,description) values('" . $name . "','" . $description . "')";
            //     // $result = mysqli_query($conn, $query);

            //     if (! empty($insertId)) {
            //         $type = "success";
            //         $message = "Excel Data Imported into the Database";
            //     } else {
            //         $type = "error";
            //         $message = "Problem in Importing Excel Data";
            //     }
            // }
        }
} else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
        }
}




}
