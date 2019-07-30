<?php
declare(strict_types=1);

include dirname(__DIR__, 1) . '/vendor/autoload.php';

use Ausi\SlugGenerator\SlugGenerator;

$serverName = "mssql";
$connectionInfo = [
    "Database" => "Film",
    "UID" => "sa",
    "PWD" => "ms3CjP{R?1^A"
];
$conn = sqlsrv_connect($serverName, $connectionInfo);

$generator = new SlugGenerator();

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

$sql = "SELECT s.searchValueId, s.searchParam FROM SearchValue s WHERE s.slug IS NULL";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$data = [];

while ($row = sqlsrv_fetch_object($stmt)) {
    $data[] = $row;
}

sqlsrv_free_stmt($stmt);

$sql = "UPDATE SearchValue SET slug = ? WHERE searchValueId = ?";

$slug = "";
$searchValueId = 0;
$stmt = sqlsrv_prepare($conn, $sql, [
    &$slug,
    &$searchValueId
]);
if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}

$delete = [];

foreach ($data as $obj) {
    $searchValueId = $obj->searchValueId;
    $slug = $generator->generate($obj->searchParam);
    if (empty($slug)) {
        echo 'Empty slug for ', $obj->searchParam, ' id ', $searchValueId, PHP_EOL;
        $delete[] = $searchValueId;
        continue;
    }
    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

sqlsrv_free_stmt($stmt);

$sql = "DELETE FROM SearchValue WHERE searchValueId = ?";

$searchValueId = 0;
$stmt = sqlsrv_prepare($conn, $sql, [
    &$searchValueId
]);

if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}

$delete = [];

foreach ($delete as $searchValueId) {
    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

sqlsrv_free_stmt($stmt);

sqlsrv_close($conn);