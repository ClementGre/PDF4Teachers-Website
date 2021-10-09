<?php
require("../php/database.php");

// get stats
if(!$result = mysqli_query($db, "SELECT * FROM stats")){
    exit(mysqli_error($db));
}

// put all in an array
$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=PDF4Teachers-Statistics.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('id', 'time', 'starts', 'version', 'date', 'language'));

if(count($users) > 0){
    foreach($users as $row){
        fputcsv($output, $row);
    }
}
