<?php
session_start();
header('Content-Type: application/json');
$command = htmlspecialchars(file_get_contents('php://input'));
$response = new StdClass();

if(empty($command)) {
    $error = true;
} else {
    switch($command) {
        case "arp -a":
            $result = "
? (192.168.0.1) ivan-pc on en0 ifscope [ethernet]
? (192.168.0.100) gov-pc on en0 ifscope permanent [ethernet]
? (192.168.0.102) sec-pc on en0 ifscope [ethernet]
? (192.168.0.107) admin-pc on en0 ifscope [ethernet]
? (192.168.0.110) backup on en0 ifscope [ethernet]
? (192.168.0.115) sec2 on en0 ifscope [ethernet]
? (192.168.0.255) broadcast on en0 ifscope [ethernet]
            ";
            break;
        case "ssh 192.168.0.107":
            $result = "sshed";
            break;
        case "cat ftp.txt":
            $result = "
ftp server: 129.124.65.8
user: asshole
pass: GOD
            ";
            break;
        default:
            $error = true;
    }
}

if(isset($error)) {
    $response = [
        'error' => "Unknown command"
    ];
} else {
    $response = [
        'response' => $result,
    ];
}

echo json_encode($response);