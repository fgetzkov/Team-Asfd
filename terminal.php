<?php
header('Content-Type: application/json');
$request = file_get_contents('php://input');
$response = new StdClass();

$response = [
    'error' => "Unknown command"
];

echo json_encode($response);