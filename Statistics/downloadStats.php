<?php
require("../php/database.php");

// get stats
$query = $db->query("SELECT * FROM app_start_updates ORDER BY date DESC");
$users = array();
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $users[] = $row;
}

$query = $db->query("SELECT * FROM app_daily_stats ORDER BY date DESC");
$dates = array();
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $dates[] = $row;
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=PDF4Teachers-Statistics.csv');
$output = fopen('php://output', 'w');

fputcsv($output, array('Per user data:'));
fputcsv($output, array('id', 'date', 'version', 'language', 'time', 'starts'));
if(count($users) > 0){
    foreach($users as $row){
        fputcsv($output, $row);
    }
}
fputcsv($output, array());
fputcsv($output, array());
fputcsv($output, array('Per day data:'));
fputcsv($output, array('date', 'unique_starts', 'unique_starts_all', 'starts', 'time', 'total_starts',
    'total_time', 'unique_lang_fr_fr', 'unique_lang_en_us', 'unique_lang_it_it', 'unique_lang_other'));
if(count($dates) > 0){
    foreach($dates as $row){
        fputcsv($output, $row);
    }
}
