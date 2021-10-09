<?php
require("../php/database.php");

// get stats
$query = $db->query("SELECT * FROM stats ORDER BY date DESC");

$users = array();
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $users[] = $row;
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
