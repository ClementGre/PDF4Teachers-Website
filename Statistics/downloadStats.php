<?php
require("../php/database.php");

$query = $db->query("SELECT * FROM stats ORDER BY date ASC");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "members-data_" . date('Y-m-d') . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers
    $fields = array('ID', 'Time', 'Starts', 'Version', 'Language', 'Date');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array($row['id'], $row['time'], $row['starts'], $row['version'], $row['language'], $row['date']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file
    fseek($f, 0);

    // Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;
//
//
//// put all in an array
//$users = array();
//if (mysqli_num_rows($result) > 0) {
//    while ($row = mysqli_fetch_assoc($result)) {
//        $users[] = $row;
//    }
//}
//
//header('Content-Type: text/csv; charset=utf-8');
//header('Content-Disposition: attachment; filename=PDF4Teachers-Statistics.csv');
//$output = fopen('php://output', 'w');
//fputcsv($output, array('id', 'time', 'starts', 'version', 'date', 'language'));
//
//if(count($users) > 0){
//    foreach($users as $row){
//        fputcsv($output, $row);
//    }
//}
